<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-neutral-800">
            {{ __('Conversas com Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="text-2xl font-semibold text-neutral-100 ms-5 mb-4">Chats com Clientes</h1>
        <div class="space-y-4 p-6">
            @if($chats->isEmpty())
            <div class="bg-neutral-800 text-neutral-300 p-6 rounded-lg shadow-md flex flex-col items-center justify-center">
                    <i class="material-icons text-6xl text-neutral-500 mb-4">chat</i>
                    <p class="text-lg font-semibold">Nenhuma conversa encontrada</p>
                    <p class="text-sm text-neutral-400 mt-2">Parece que você ainda não tem conversas com clientes.</p>
                </div>
            @else
            @foreach($chats as $chat)
                <div onclick="openChat({{ $chat->id }}, '{{ $chat->user ? $chat->user->name : 'Anônimo' }}')"
                    class="bg-neutral-700 hover:bg-neutral-600 hover:cursor-pointer rounded-lg shadow-md flex p-4 transition-all duration-700">
                    <div class="flex w-full items-center text-neutral-100 space-x-2 mr-4">
                        <img src="{{ $chat->user ? $chat->user->imageURL : '/assets/images/users/default.png' }}" 
                            alt="User Icon" 
                            class="text-center w-16 h-16 rounded-full">

                        <div class="flex flex-col w-full h-full pb-1">
                            <div class="flex items-center space-x-4">
                                <h2 class="text-xl text-white">{{ $chat->user ? $chat->user->name : 'Anônimo' }}</h2>
                                <p class="text-sm text-neutral-400">{{ \Carbon\Carbon::parse($chat->created_at)->diffForHumans() }}</p>
                            </div>

                            <p class="text-md text-neutral-400 mt-auto truncate-2-lines mr-6">
                                @if($chat->lastMessage)
                                    <strong>{{ $chat->lastMessage->senderType === 'store' ? 'Você' : 'Cliente' }}:</strong> 
                                    {{ $chat->lastMessage->message }}
                                @else
                                    Cliente iniciou esta conversa
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex space-x-2 ml-4 items-center">
                        <button class="text-neutral-100 hover:text-red-500">
                            <i class="material-icons text-4xl">chevron_right</i>
                        </button>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
    <!-- Modal -->
    <x-modal name="chat-modal" :show="false" maxWidth="3xl">
        <div class="p-6">
            <div class="flex w-full items-center justify-between mb-4">
                <h2 class="text-lg text-white">Chat com <span id="chatUser" class="font-semibold"></span></h2>
                <i class="material-icons text-4xl text-white hover:text-neutral-400 hover:cursor-pointer" x-on:click="$dispatch('close-modal', 'chat-modal')" >close</i>
            </div>

            <div id="messagesContainer" class="chatContainer overflow-y-auto space-y-3 p-3 rounded-md">
                <p class="text-neutral-400 text-center">Carregando mensagens...</p>
            </div>

            <div class="flex mt-4 space-x-2 w-full">
                <x-textarea-input type="text" id="messageInput" class="w-full" placeholder="Digite sua mensagem..." oninput="updateCharacterCount()" />
                <button onclick="sendMessage()" class="flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-500 transition-all">Enviar<i class="material-icons ml-2">send</i></button>
            </div>
            <div id="charCount" class="text-sm text-neutral-400 mt-1 hidden">0/1000</div>
        </div>
    </x-modal>

    <script>
        function openChat(chatId, userName) {
            document.getElementById('chatUser').innerText = userName;
            document.getElementById('chatUser').setAttribute('data-chat-id', chatId); // Adiciona o chatId ao elemento

            // Dispara evento Alpine.js para abrir o modal
            window.dispatchEvent(new CustomEvent('open-modal', { detail: "chat-modal" }));

            fetch(`/chats/${chatId}/messages`)
            .then(response => response.json())
            .then(data => {
                let messagesContainer = document.getElementById('messagesContainer');
                messagesContainer.innerHTML = '';

                if (data.messages.length === 0) {
                    messagesContainer.innerHTML = '<p class="text-neutral-400 text-center">Nenhuma mensagem ainda.</p>';
                    return;
                }

                data.messages.forEach(msg => {
                    let alignment = msg.senderType === 'store' ? 'justify-end' : 'justify-start';
                    let bgColor = msg.senderType === 'store' ? 'bg-yellow-500' : 'bg-neutral-500';
                    let time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                    let messageElement = `
                        <div class="flex ${alignment}">
                            <p class="${bgColor} text-white p-2 rounded-lg max-w-sm">${msg.message}</p>
                            <span class="text-neutral-300 text-sm ml-2">${time}</span>
                        </div>
                    `;
                    messagesContainer.innerHTML += messageElement;
                });
            });
        }

        function sendMessage() {
            let messageInput = document.getElementById('messageInput');
            let message = messageInput.value.trim();

            if (message === '') {
                alert('Por favor, digite uma mensagem.');
                return;
            }

            let chatId = document.getElementById('chatUser').getAttribute('data-chat-id'); // Se você quiser passar o chatId do modal
            messageInput.value = ''; // Limpa o campo de input após o envio
            updateCharacterCount(); // Reinicia o contador após envio

            // Envia a mensagem para o servidor
            fetch(`/chats/${chatId}/send`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Garantir o token CSRF
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let messagesContainer = document.getElementById('messagesContainer');
                    let alignment = 'justify-end'; // Loja sempre envia à direita
                    let bgColor = 'bg-yellow-500';
                    let time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                    let messageElement = `
                        <div class="flex ${alignment}">
                            <p class="${bgColor} text-white p-2 rounded-lg max-w-sm">${message}</p>
                            <span class="text-neutral-300 text-sm ml-2">${time}</span>
                        </div>
                    `;
                    messagesContainer.innerHTML += messageElement;
                    messagesContainer.scrollTop = messagesContainer.scrollHeight; // Rola para o final da conversa
                } else {
                    alert('Erro ao enviar a mensagem, tente novamente.');
                }
            })
            .catch(error => {
                console.error('Erro ao enviar mensagem:', error);
                alert('Erro ao enviar a mensagem, tente novamente.');
            });
        }

        function updateCharacterCount() {
            let messageInput = document.getElementById('messageInput');
            let charCount = document.getElementById('charCount');
            let charLength = messageInput.value.length;

            // Mostrar o contador apenas depois de 500 caracteres
            if (charLength > 500) {
                charCount.classList.remove('hidden'); // Exibe o contador
            } else {
                charCount.classList.add('hidden'); // Esconde o contador
            }

            // Atualiza o contador de caracteres
            charCount.innerText = `${charLength}/1000`;

            // Mudar a cor do contador para vermelho se ultrapassar 1000 caracteres
            if (charLength >= 1000) {
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
            }

            // Se ultrapassar 1000 caracteres, impede a digitação
            if (charLength > 1000) {
                messageInput.value = messageInput.value.substring(0, 1000); // Limita o comprimento
                charCount.innerText = "1000/1000"; // Ajusta o contador
            }
        }
    </script>

    <style>
        .truncate-2-lines {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</x-app-layout>
