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
                            <p class="text-sm text-neutral-400">Avaliações: {{ $product->evaluations_count }}</p>

                            <p class="text-sm text-neutral-300 mt-1">{{ $product->description }}</p>
                            <p class="text-sm font-semibold text-green-400 mt-1">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                            <!-- <p class="inline-flex items-center text-xs text-neutral-200 border border-neutral-200 rounded-full px-1">
                                <i class="material-icons mx-1" style="font-size: 1.2rem;">category</i> Headset
                            </p> -->
                        </div>
                        <div class="flex space-x-2 mr-4 items-center">
                            <button class="text-neutral-100 hover:text-yellow-500 transition-all" onclick="openEditModal({{ $product->id }}, '{{ $product->name }}', '{{ $product->description }}', '{{ $product->price }}')">
                                <i class="material-icons">edit</i>
                            </button>
                            <button class="text-neutral-100 hover:text-red-500 transition-all" onclick="openDeleteModal({{ $product->id }})">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- Modal para Alteração -->
    <x-modal name="edit-product-modal" :show="false" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg text-white font-semibold">Editar Produto</h2>
            <form id="editProductForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" id="editProductId">

                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Nome</label>
                    <x-text-input type="text" id="editProductName" class="w-full" />
                </div>

                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Descrição</label>
                    <x-textarea-input id="editProductDescription" class="w-full"></x-textarea-input>
                </div>

                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Preço</label>
                    <x-text-input type="number" id="editProductPrice" step="0.01" class="w-full" />
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'edit-product-modal')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button id="saveEditProductBtn">
                        Salvar
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
    <!-- Modal para Exclusão -->
    <x-modal name="delete-product-modal" :show="false" maxWidth="md">
    <div class="p-6">
        <h2 class="text-lg text-white font-semibold">Confirmar Exclusão</h2>
        <p class="text-sm text-neutral-400 mt-2">Tem certeza de que deseja excluir este produto? Esta ação não pode ser desfeita.</p>
        
        <div class="flex justify-end mt-4 space-x-2">
            <x-secondary-button x-on:click="$dispatch('close-modal', 'delete-product-modal')">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="" id="confirmDeleteBtn">
                Excluir
            </x-danger-button>
        </div>
    </div>
</x-modal>

<script>
    // Disparar modal de alteração
    function openEditModal(id, name, description, price) {
        document.getElementById('editProductId').value = id;
        document.getElementById('editProductName').value = name;
        document.getElementById('editProductDescription').value = description;
        document.getElementById('editProductPrice').value = price;

        window.dispatchEvent(new CustomEvent('open-modal', { detail: "edit-product-modal" }));
    }

    document.getElementById('saveEditProductBtn').addEventListener('click', function (e) {
        e.preventDefault();

        let productId = document.getElementById('editProductId').value;
        let formData = new FormData();
        formData.append('name', document.getElementById('editProductName').value);
        formData.append('description', document.getElementById('editProductDescription').value);
        formData.append('price', document.getElementById('editProductPrice').value);
        formData.append('_method', 'PUT');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        console.log('Id do Produto: ', productId)

        fetch(`/products/${productId}/edit`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erro ao editar o produto.');
                // console.log(data)
            }
        })
        .catch(error => console.error('Erro ao editar produto:', error));
    });

    // Disparar modal de exclusão
    function openDeleteModal(productId) {
        document.getElementById('confirmDeleteBtn').setAttribute('data-product-id', productId);
        window.dispatchEvent(new CustomEvent('open-modal', { detail: "delete-product-modal" }));
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        let productId = this.getAttribute('data-product-id');
        
        fetch(`/products/${productId}/delete`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Atualiza a página para refletir a exclusão
            } else {
                alert('Erro ao excluir o produto.');
            }
        })
        .catch(error => console.error('Erro ao excluir produto:', error));
    });
</script>
</x-app-layout>
