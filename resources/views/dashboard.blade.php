<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-neutral-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 p-6">
                    @if($products->isEmpty())
                        <p class="text-neutral-300">Nenhum produto encontrado.</p>
                    @else
                        @foreach($products as $product)
                            <div class="bg-neutral-700 p-4 rounded-lg shadow-md">
                                <img src="{{ $product->imageURL }}" alt="{{ $product->name }}" class="w-full h-28 w-28 object-cover mb-4">
                                <h2 class="text-lg font-bold text-neutral-100">{{ $product->name }}</h2>
                                <p class="text-neutral-300">{{ $product->description }}</p>
                                <p class="text-neutral-100 font-semibold">{{ $product->price }}</p>
                                <button class="mt-2 bg-blue-500 text-white py-2 px-4 rounded">Add to Cart</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
