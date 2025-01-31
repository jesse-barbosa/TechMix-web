<x-guest-layout>
    <div class="mb-4 text-sm text-neutral-400">
        {{ __('Esqueceu sua senha? Não há problema. Basta informar seu endereço de email e receberá um link de redefinição de senha que permitirá escolher uma nova.') }}
    </div>


    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="flex w-full justify-center mt-4">
            <x-primary-button>
                {{ __('Enviar link de redefinição de senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
