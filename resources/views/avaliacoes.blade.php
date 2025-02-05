<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-neutral-800">
            {{ __('Avaliações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h1 class="text-2xl font-semibold text-neutral-100 ms-5 mb-4">Avaliações de Produtos</h1>
        <div class="space-y-4 p-6">
            @if($reviews->isEmpty())
                <p class="text-neutral-300">Nenhuma avaliação encontrada.</p>
            @else
                @foreach($reviews as $review)
                    <div class="bg-neutral-700 rounded-lg shadow-md flex p-2">
                        <div class="flex flex-col w-1/6 items-center justify-center text-neutral-100 space-y-2 mr-4">
                            <img src="{{ $review->user ? $review->user->imageURL : '/assets/images/users/default.png' }}" 
                                alt="User Icon" 
                                class="text-center w-14 h-14 rounded-full">
                                 
                            <h2 class="text-sm font-bold text-center">{{ $review->user ? $review->user->name : 'Anônimo' }}</h2>
                        </div>
                        
                        <div class="flex w-full flex-grow flex-col justify-between">
                            <!-- Product Information -->
                            <div class="flex items-center mb-4 bg-neutral-800 rounded-lg p-2">
                                <img src="{{ $review->product->imageURL }}" alt="Product Image" class="w-12 h-12 rounded-sm">
                                <div clas="flex flex-col">
                                    <p class="ml-4 text-sm text-neutral-300">{{ $review->product->name }}</p>
                                    <p class="ml-4 text-sm text-green-500">R$ {{ $review->product->price }}</p>
                                </div>
                            </div>

                            <div class="flex items-center text-sm space-x-4">
                                <p class="flex items-center">
                                    @for ($i = 0; $i < $review->stars; $i++)
                                        <i class="material-icons text-yellow-500">star</i>  <!-- Estrelas preenchidas -->
                                    @endfor

                                    @for ($i = $review->stars; $i < 5; $i++)
                                        <i class="material-icons text-neutral-400">star</i>  <!-- Estrelas vazias -->
                                    @endfor
                                </p>
                                <p class="text-sm text-neutral-300">{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}</p>
                            </div>
                            <p class="text-sm text-neutral-300 py-4">{{ $review->message }}</p>
                        </div>
                        <div class="flex space-x-2 ml-6 mr-4 items-center">
                            <button class="text-neutral-100 hover:text-red-500">
                                <i class="material-icons">report</i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
