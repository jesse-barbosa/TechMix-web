<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">

        <!-- The @csrf directive generates a hidden input field containing a CSRF token, which helps protect the application from cross-site request forgery attacks. -->
        @csrf

        <h2 class="text-xl text-white font-bold">{{ __('Entre na sua conta') }}</h2>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative">
                
                <x-text-input id="email" class="block mt-1 w-full pl-10 pr-10"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required autofocus autocomplete="username"
                                placeholder="{{ __('exemplo@techmix.com') }}"
                                icon="fas fa-envelope" />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pl-10 "
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="{{ __('********') }}"
                                icon="fas fa-lock" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-neutral-900 border-neutral-700 text-yellow-600 shadow-sm focus:ring-yellow-600 focus:ring-offset-neutral-800" name="remember">
                <span class="ms-2 text-sm text-neutral-400">{{ __('Lembrar de mim') }}</span>
            </label>
        </div>

        <x-primary-button class="w-full my-4">
            {{ __('Entrar') }}
        </x-primary-button>
        
        <div class="mb-4 text-center">
            <span class="text-sm text-neutral-400 hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 focus:ring-offset-neutral-800">
                {{ __('Não tem uma conta TechMix?') }}
            </span>
            <a class="underline text-sm text-yellow-400 hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 focus:ring-offset-neutral-800" href="{{ route('register') }}">
                    {{ __('Registre-se') }}
            </a>
        </div>
    </form>
</x-guest-layout>
