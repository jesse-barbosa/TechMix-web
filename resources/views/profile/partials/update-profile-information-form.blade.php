<section>
    <header>
        <h2 class="text-lg font-medium text-neutral-100">
            {{ __('Informações da Loja') }}
        </h2>

        <p class="mt-1 text-sm text-neutral-400">
            {{ __("Atualize informações do perfil da sua loja") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="w-full mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex justify-center my-3">
            <div class="flex justify-center w-full max-w-80">
                <img src="{{ old('ImageURL', $user->imageURL) }}" class="h-64 w-64 rounded-full" alt="Foto da Loja">
            </div>
            <div class="w-full space-y-6">
                <div>
                    <x-input-label for="name" :value="__('Nome')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" placeholder="Digite o nome da sua loja" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" placeholder="Digite seu email" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
                <div x-data="{ description: '{{ old('description', $user->description) }}', count: {{ strlen(old('description', $user->description)) }}, max: 500 }">
                    <x-input-label for="description" :value="__('Descrição')" />
                    <x-textarea-input 
                        id="description" 
                        name="description" 
                        class="mt-1 block w-full"
                        x-model="description"
                        x-on:input="count = description.length"
                        maxlength="500"
                        placeholder="Descreva sua loja em até 500 caracteres"
                    ></x-textarea-input>
                    
                    <div class="text-sm text-neutral-400 mt-1">
                        <span x-text="count"></span> / <span x-text="max"></span> caracteres
                    </div>

                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
            </div>
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <x-input-label for="postalCode" :value="__('CEP')" />
                <x-text-input id="postalCode" name="postalCode" type="text" class="mt-1 block w-full" :value="old('postalCode', $user->postalCode)" placeholder="Digite o CEP" />
                <span id="cep-error" class="text-red-500 text-sm mt-2"></span>
                <x-input-error class="mt-2" :messages="$errors->get('postalCode')" />
            </div>
            <div class="w-full">
                <x-input-label for="cnpj" :value="__('CNPJ')" />
                <x-text-input id="cnpj" name="cnpj" type="text" class="mt-1 block w-full" :value="old('cnpj', $user->cnpj)" placeholder="Digite o CNPJ" required />
                <x-input-error class="mt-2" :messages="$errors->get('cnpj')" />
            </div>
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <x-input-label for="street" :value="__('Rua')" />
                <x-text-input id="street" name="street" type="text" class="mt-1 block w-full" :value="old('street', $user->street)" placeholder="Digite o nome da rua" />
                <x-input-error class="mt-2" :messages="$errors->get('street')" />
            </div>
            <div class="w-full">
                <x-input-label for="number" :value="__('Número')" />
                <x-text-input id="number" name="number" type="text" class="mt-1 block w-full" :value="old('number', $user->number)" placeholder="Digite o número" />
                <x-input-error class="mt-2" :messages="$errors->get('number')" />
            </div>
        </div>
        <div class="flex space-x-4">
            <div class="w-full">
                <x-input-label for="city" :value="__('Cidade')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" placeholder="Digite o nome da cidade" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div class="w-full">
                <x-input-label for="state" :value="__('Estado')" />
                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $user->state)" placeholder="Digite o estado" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />
            </div>
        </div>
        <div>
            <x-input-label for="complement" :value="__('Complemento')" />
            <x-text-input id="complement" name="complement" type="text" class="mt-1 block w-full" :value="old('complement', $user->complement)" placeholder="Digite o complemento (se houver)" />
            <x-input-error class="mt-2" :messages="$errors->get('complement')" />
        </div>

        <div>
            <x-input-label for="neighborhood" :value="__('Bairro')" />
            <x-text-input id="neighborhood" name="neighborhood" type="text" class="mt-1 block w-full" :value="old('neighborhood', $user->neighborhood)" placeholder="Digite o nome do bairro" />
            <x-input-error class="mt-2" :messages="$errors->get('neighborhood')" />
        </div>

        <!-- <div>
            <x-input-label for="status" :value="__('Status')" />
            @php
            $status = old('status', $user->status);
            $statusText = match ($status) {
                0 => 'Desativado',
                1 => 'Ativado',
                default => 'Desconhecido',
            }
            @endphp
            <x-text-input id="status" name="status" type="text" class="mt-1 block w-full" value="{{ $statusText }}" />
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div> -->

        <div class="flex flex-col items-center justify-center gap-4 w-full">
            <x-primary-button>{{ __('Atualizar Dados') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-green-400"
                >{{ __('Alterações salvas com Sucesso.') }}</p>
            @endif
        </div>
    </form>

    <script>
        function autoCompleteAddress() {
            const cep = document.getElementById('cep').value.replace(/\D/g, ''); // Remove caracteres não numéricos
            const errorMessage = document.getElementById('cep-error');
            
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('street').value = data.logradouro;
                            document.getElementById('neighborhood').value = data.bairro;
                            document.getElementById('city').value = data.localidade;
                            document.getElementById('state').value = data.uf;
                            errorMessage.textContent = ''; // Remove a mensagem de erro se o CEP for válido
                        } else {
                            errorMessage.textContent = 'CEP não encontrado.';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar o CEP:', error);
                        errorMessage.textContent = 'Erro ao buscar o CEP. Tente novamente mais tarde.';
                    });
            } else {
                errorMessage.textContent = 'CEP inválido. Insira um CEP válido com 8 dígitos.';
            }
        }
    </script>
    
</section>
