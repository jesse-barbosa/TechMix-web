<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">

        <!-- The @csrf directive generates a hidden input field containing a CSRF token, which helps protect the application from cross-site request forgery attacks. -->
        @csrf

        <h2 class="text-xl text-white font-bold">{{ __('Crie uma conta') }}</h2>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Nome da Empresa')" />
            <div class="relative">
                <x-text-input id="name" class="block mt-1 w-full pl-10" type="text" name="name" required autofocus autocomplete="name" placeholder="{{ __('Nome') }}" icon="fas fa-building" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail da Empresa')" />
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" required autocomplete="email" placeholder="{{ __('exemplo@techmix.com') }}" icon="fas fa-envelope" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Access Key -->
        <div class="mt-4">
            <x-input-label for="access_key" :value="__('Chave de Acesso')" />
            <div class="relative">
                <x-text-input id="access_key" class="block mt-1 w-full pl-10" type="text" name="access_key" required autocomplete="access_key" placeholder="{{ __('********') }}" icon="fas fa-key" />
            </div>
            <x-input-error :messages="$errors->get('access_key')" class="mt-2" />
        </div>

        <!-- Address Group -->
        <div class="mt-4 flex space-x-4">
            <div class="flex-1">
                <x-input-label for="cep" :value="__('CEP')" />
                <div class="relative">
                    <x-text-input id="cep" class="block mt-1 w-full pl-10" type="text" name="cep" required autocomplete="cep" oninput="checkCEP()" placeholder="{{ __('00000-000') }}" icon="fas fa-map-marker-alt" />
                </div>
                <span id="cep-error" class="text-red-500 text-sm mt-2"></span>
                <x-input-error id="cep-error" :messages="$errors->get('cep')" class="mt-2" />
            </div>
            <div class="flex-1 ms-2">
                <x-input-label for="cnpj" :value="__('CNPJ')" />
                <div class="relative">
                    <x-text-input id="cnpj" class="block mt-1 w-full pl-10" type="text" name="cnpj" required autocomplete="cnpj" placeholder="{{ __('00.000.000/0000-00 ') }}" icon="fas fa-id-card" />
                </div>
                <x-input-error :messages="$errors->get('cnpj')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4 flex space-x-4">
            <div class="flex-1">
                <x-input-label for="street" :value="__('Rua')" />
                <div class="relative">
                    <x-text-input id="street" class="block mt-1 w-full pl-10" type="text" name="street" required autocomplete="street" placeholder="{{ __('Rua') }}" icon="fas fa-road" />
                </div>
                <x-input-error :messages="$errors->get('street')" class="mt-2" />
            </div>
            <div class="flex-1 ms-2">
                <x-input-label for="number" :value="__('Número')" />
                <div class="relative">
                    <x-text-input id="number" class="block mt-1 w-full pl-10" type="text" name="number" required autocomplete="number" placeholder="{{ __('Número') }}" icon="fas fa-sort-numeric-up-alt" />
                </div>
                <x-input-error :messages="$errors->get('number')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4 flex space-x-4">
            <div class="flex-1">
                <x-input-label for="neighborhood" :value="__('Bairro')" />
                <div class="relative">
                    <x-text-input id="neighborhood" class="block mt-1 w-full pl-10" type="text" name="neighborhood" required autocomplete="neighborhood" placeholder="{{ __('Bairro') }}" icon="fas fa-map-marker-alt" />
                </div>
                <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
            </div>
            <div class="flex-1 ms-2">
                <x-input-label for="city" :value="__('Cidade')" />
                <div class="relative">
                    <x-text-input id="city" class="block mt-1 w-full pl-10" type="text" name="city" required autocomplete="city" placeholder="{{ __('Cidade') }}" icon="fas fa-city" />
                </div>
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="state" :value="__('Estado')" />
            <div class="relative">
                <x-text-input id="state" class="block mt-1 w-full pl-10" type="text" name="state" required autocomplete="state" placeholder="{{ __('Estado') }}" icon="fas fa-map-signs" />
            </div>
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div>

        <x-primary-button class="w-full my-4">
            {{ __('Registrar') }}
        </x-primary-button>

        <div class="mb-4 text-center">
            <span class="text-sm text-neutral-400 hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 focus:ring-offset-neutral-800">
                {{ __('Já tem uma conta TechMix?') }}
            </span>
            <a class="underline text-sm text-yellow-400 hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 focus:ring-offset-neutral-800" href="{{ route('login') }}">
                    {{ __('Faça Login') }}
            </a>
        </div>
    </form>
    
    <script>
        function checkCEP() {
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

</x-guest-layout>
