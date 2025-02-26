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
        @method('post')

        <div class="flex justify-center my-3">
            <div x-data="{ open: false }">
                <button type="button" x-on:click="$dispatch('open-modal', 'imageUploadModal')" class="relative w-64 mr-4">
                    <img src="{{ old('imageURL', $user->imageURL ?? asset('/assets/images/stores/default.png')) }}" class="max-h-56 max-w-56 rounded-full text-neutral-400" alt="Foto da Loja">
                    <div class="absolute top-0 right-0 h-10 w-10 p-2 bg-neutral-700 hover:bg-neutral-600 rounded-full hover:cursor-pointer">
                        <i class="material-icons text-neutral-300">edit</i>
                    </div>
                </button>

                <!-- Use the modal component -->
                <x-modal name="imageUploadModal" :show="false" maxWidth="md">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4 text-neutral-100">Selecione a Imagem</h3>

                        <!-- Use the image-input component -->
                        <x-image-input id="profileImage" name="imageURL" :preview="old('imageURL', $user->imageURL)" />

                        <div class="flex justify-end mt-4 space-x-2">
                            <x-secondary-button x-on:click="$dispatch('close-modal', 'imageUploadModal')">
                                Cancelar
                            </x-secondary-button>
                            <x-primary-button id="saveProfileImageBtn" type="button">
                                Salvar
                            </x-primary-button>
                        </div>
                    </div>
                </x-modal>
            </div>

            <div class="w-full space-y-6 ml-4">
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

        document.addEventListener('DOMContentLoaded', function () {
            const saveButton = document.getElementById('saveProfileImageBtn');
            if (saveButton) {
                saveButton.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Salvar button clicked');

                    let formData = new FormData();
                    const imageInput = document.getElementById('profileImage');
                    if (imageInput.files.length > 0) {
                        formData.append('imageURL', imageInput.files[0]);
                    }
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    fetch('/profile/update-image', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        console.log('Response received:', response);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Data received:', data);
                        if (data.success) {
                            location.reload(); // Atualiza a página
                        } else {
                            alert('Erro ao atualizar a imagem do perfil.');
                        }
                    })
                    .catch(error => console.error('Erro ao atualizar imagem do perfil:', error));
                });
            } else {
                console.error('Save button not found');
            }
        });
    </script>
    
</section>
