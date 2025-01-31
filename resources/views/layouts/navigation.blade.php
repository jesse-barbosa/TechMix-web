<nav x-data="{ open: false }" class="fixed bg-neutral-800 border-b border-neutral-700 h-screen" :class="{ 'w-1/8': expanded, 'w-16': !expanded }">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto">
        <div class="flex flex-col justify-between h-screen">
            <!-- Logo and Toggle Button -->
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="block h-9 w-auto fill-current text-neutral-200">
                </a>
                <button @click="$dispatch('toggle-expanded'); expanded = !expanded;" class="top-5 left-16 p-2 text-neutral-400 hover:text-neutral-300" :class="{ 'absolute': !expanded }">
                    <span class="material-icons" :class="{ 'rotate-180': expanded }">chevron_right</span>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col items-center space-y-6">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">
                    <span x-show="expanded">{{ __('Dashboard') }}</span>
                </x-nav-link>
                <x-nav-link :href="route('produtos')" :active="request()->routeIs('produtos')" icon="devices">
                    <span x-show="expanded">{{ __('Produtos') }}</span>
                </x-nav-link>
                <x-nav-link :href="route('avaliacoes')" :active="request()->routeIs('avaliacoes')" icon="reviews">
                    <span x-show="expanded">{{ __('Avaliações') }}</span>
                </x-nav-link>
                <x-nav-link :href="route('ajustes')" :active="request()->routeIs('ajustes')" icon="settings">
                    <span x-show="expanded">{{ __('Ajustes') }}</span>
                </x-nav-link>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center mt-4">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <div class="flex justify-between items-center w-full p-2 border border-transparent text-sm text-neutral-400 hover:text-neutral-300">
                            <img src="{{ Auth::user()->imageURL }}" alt="Store Image" class="w-8 h-8 rounded-full">
                            <div x-show="expanded" class="w-full text-md mx-2">{{ Auth::user()->name }}</div>
                            <div>
                                <span class="material-icons">more_vert</span>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>