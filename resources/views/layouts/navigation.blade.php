<nav x-data="{ open: false, expanded: false }" class="fixed bg-neutral-800 border-b border-neutral-700 h-screen shadow-lg" :class="{ 'w-1/8': expanded, 'w-16': !expanded }">
    <div class="max-w-full mx-auto">
        <div class="flex flex-col justify-between h-screen">
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="block h-9 w-auto fill-current text-neutral-200">
                </a>
                <button @click="$dispatch('toggle-expanded'); expanded = !expanded;" class="top-5 left-16 p-2 text-neutral-400 hover:text-neutral-300" :class="{ 'absolute': !expanded }">
                    <span class="material-icons" :class="{ 'rotate-180': expanded }">chevron_right</span>
                </button>
            </div>

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

            <div class="relative flex items-center mt-4">
                <div class="flex justify-between items-center w-full p-2 border border-transparent text-sm text-neutral-400 hover:text-neutral-300 cursor-pointer" @click="open = !open">
                    <img src="{{ Auth::user()->imageURL }}" alt="User Image" class="w-8 h-8 rounded-full">
                    <div x-show="expanded" class="w-full text-md mx-2">{{ Auth::user()->name }}</div>
                    <span class="material-icons">more_vert</span>
                </div>
                
                <div x-show="open" @click.away="open = false" class="absolute z-50 left-20 bottom-2 w-64 bg-neutral-700 text-white rounded-lg shadow-lg mt-2">
                    <button @click="open = false" class="absolute right-2  text-white hover:text-gray-200 text-4xl">&times;</button>
                    <div class="flex flex-col items-center">
                        <div class="w-full h-12 rounded-lg rounded-b-none bg-yellow-500"></div>
                        <img src="{{ Auth::user()->imageURL }}" alt="User Image" class="w-24 h-24 rounded-full -mt-6 border-4 border-neutral-700">
                        <div class="text-center py-4">
                            <div class="text-md font-semibold">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-neutral-300">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="my-3">
                        <a href="{{ route('profile.edit') }}" class="flex items-center w-full text-left px-4 py-1 text-sm hover:text-neutral-400 hover:underline transition"><span class="material-icons mr-4">settings</span> Configurações da Loja</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full text-left px-4 py-1 text-sm text-red-600 hover:text-red-500 mt-2 hover:underline transition"><span class="material-icons mr-4">power_settings_new</span> Log out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>