<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-neutral-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex flex-row justify-between bg-neutral-800 text-white p-10 text-center">
        <div class="flex w-1/3">
            <p class="text-2xl font-medium text-start">Transforme suas <span class="text-yellow-500">ideias</span> em realidade com seu próprio <span class="text-yellow-500">e-commerce</span></p>
        </div>            
        <div class="flex">
            <x-primary-button class="mt-2">Adicionar produto</x-primary-button>
        </div>
    </div>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Info Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 p-6">
                    <div class="bg-neutral-700 p-4 rounded-lg shadow-md flex items-center">
                        <i class="material-icons text-3xl mr-2 bg-blue-200 text-blue-800 rounded-full p-2">devices</i>
                        <div>
                            <h2 class="text-sm font-normal text-neutral-300">Produtos da Loja</h2>
                            <p class="text-neutral-100 text-2xl">{{ $products->count() }}</p>
                        </div>
                    </div>
                    <div class="bg-neutral-700 p-4 rounded-lg shadow-md flex items-center">
                        <i class="material-icons text-3xl mr-2 bg-green-200 text-green-800 rounded-full p-2">thumb_up</i>
                        <div>
                            <h2 class="text-sm font-normal text-neutral-300">Avaliações Positivas</h2>
                            <p class="text-neutral-100 text-2xl">95%</p>
                        </div>
                    </div>
                    <div class="bg-neutral-700 p-4 rounded-lg shadow-md flex items-center">
                        <i class="material-icons text-3xl mr-2 bg-red-200 text-red-800 rounded-full p-2">thumb_down</i>
                        <div>
                            <h2 class="text-sm font-normal text-neutral-300">Avaliações Negativas</h2>
                            <p class="text-neutral-100 text-2xl">5%</p>
                        </div>
                    </div>
                </div>
                <h1 class="text-2xl font-semibold text-neutral-100 ms-5 mb-4">Produtos recentes</h1>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 p-6">
                    @if($products->isEmpty())
                        <p class="text-neutral-300">Nenhum produto encontrado.</p>
                    @else
                        @foreach($products->take(5) as $product)
                            <div class="bg-neutral-700 rounded-lg shadow-md flex flex-col">
                                <img src="{{ $product->imageURL }}" alt="{{ $product->name }}" class="w-full h-32 object-cover rounded">
                                <div class="flex-grow p-4">
                                    <h2 class="text-md font-bold text-neutral-100">{{ $product->name }}</h2>
                                    <p class="text-sm text-neutral-300">{{ $product->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
