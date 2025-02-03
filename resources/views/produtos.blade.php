<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-neutral-800">
            {{ __('Catálogo de Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="text-2xl font-semibold text-neutral-100 ms-5 mb-4">Catálogo de Produtos</h1>
        <div class="space-y-4 p-6">
            @if($products->isEmpty())
                <p class="text-neutral-300">Nenhum produto encontrado.</p>
            @else
                @foreach($products as $product)
                    <div class="bg-neutral-700 rounded-lg shadow-md flex">
                        <img src="{{ $product->imageURL }}" alt="{{ $product->name }}" class="w-28 h-full object-cover rounded-lg rounded-r-none mr-4">
                        <div class="flex-grow">
                            <div class="flex flex-row gap-2 mt-2">
                                <h2 class="text-md font-bold text-neutral-100">{{ $product->name }}</h2>
                                <span class="flex items-center justify-center text-xs rounded-full px-1 py-0 text-white font-semibold
                                    {{ $product->status == '0' ? 'bg-neutral-500' : ($product->status == '1' ? 'bg-green-600' : 'bg-red-600') }}">
                                    @if($product->status == '0') Desativado @elseif($product->status == '1') Ativado @elseif($product->status == '2') Suspenso <i class="material-icons mx-1" style="font-size: 1rem;">warning</i> @endif
                                </span>
                            </div>
                            <p class="text-sm text-neutral-300">{{ $product->description }}</p>
                            <!-- <p class="inline-flex items-center text-xs text-neutral-200 border border-neutral-200 rounded-full px-1">
                                <i class="material-icons mx-1" style="font-size: 1.2rem;">category</i> Headset
                            </p> -->
                            <p class="text-sm text-neutral-400">Avaliações: {{ $product->evaluations_count }}</p>
                        </div>
                        <div class="flex space-x-2 ml-4 items-center">
                            <button class="text-neutral-100 hover:text-yellow-500">
                                <i class="material-icons">edit</i>
                            </button>
                            <button class="text-neutral-100 hover:text-red-500">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
