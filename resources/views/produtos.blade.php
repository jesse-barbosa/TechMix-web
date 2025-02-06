<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-neutral-800">
            {{ __('Catálogo de Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex justify-between mb-4 ps-5">
            <h1 class="text-2xl font-semibold text-neutral-100">Catálogo de Produtos</h1>
            <div class="flex w-1/5 justify-center items-center">
                <div class="flex max-h-14">
                    <x-primary-button x-on:click="$dispatch('open-modal', 'add-product-modal')">
                        Adicionar produto
                    </x-primary-button>
                </div>
            </div>
        </div>

        <div class="space-y-4 p-6">
            @if($products->isEmpty())
                <p class="text-neutral-300">Nenhum produto encontrado.</p>
            @else
                @foreach($products as $product)
                    <div class="bg-neutral-700 rounded-lg shadow-md flex">
                        <img src="{{ $product->imageURL }}" alt="{{ $product->name }}" class="w-28 min-h-full object-cover rounded-lg rounded-r-none mr-4">
                        <div class="flex-grow">
                            <div class="flex flex-row gap-2 mt-2">
                                <h2 class="text-md font-bold text-neutral-100">{{ $product->name }}</h2>
                                <span class="flex items-center justify-center text-xs rounded-full px-1 py-0 text-white font-semibold
                                    {{ $product->status == '0' ? 'bg-neutral-500' : ($product->status == '1' ? 'bg-green-600' : 'bg-red-600') }}">
                                    @if($product->status == '0') Desativado @elseif($product->status == '1') Ativado @elseif($product->status == '2') Suspenso <i class="material-icons mx-1" style="font-size: 1rem;">warning</i> @endif
                                </span>
                            </div>
                            
                            <!-- Exibir a média das avaliações como estrelas -->
                            <div class="flex items-center space-x-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="material-icons {{ $i < $product->averageRating ? 'text-yellow-500' : 'text-neutral-400' }}">
                                        star
                                    </i>
                                @endfor
                                <span class="text-sm text-neutral-300 ml-2">{{ $product->reviews_count }} avaliações</span>
                            </div>

                            <p class="text-sm text-neutral-300 mt-1">{{ $product->description }}</p>
                            <p class="text-sm font-semibold text-green-400 mt-1">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        </div>
                        <div class="flex space-x-2 mr-4 items-center">
                            <button class="text-neutral-100 hover:text-yellow-500 transition-all" 
                                onclick='openEditModal({{ $product->id }}, {!! json_encode($product->name) !!}, {!! json_encode($product->description) !!}, {!! json_encode($product->price) !!}, {!! json_encode($product->imageURL) !!})'>
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

    <!-- Modal para Adicionar Produto -->
    <x-modal name="add-product-modal" :show="false" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg text-white font-semibold">Adicionar Produto</h2>
            <form id="addProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                <x-image-input id="productImage" name="image" :preview="''" required />
                
                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Nome</label>
                    <x-text-input type="text" id="productName" name="name" class="w-full" required />
                </div>
                
                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Descrição</label>
                    <x-textarea-input id="productDescription" name="description" class="w-full"></x-textarea-input>
                </div>
                
                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Preço</label>
                    <x-text-input type="text" id="productPrice" name="price" class="w-full" required 
                        value="R$ 0,00"
                        oninput="
                            let value = this.value.replace(/[^0-9]/g, '');
                            value = value ? parseInt(value, 10).toString() : '0';
                            value = value.padStart(3, '0');
                            value = value.slice(0, -2) + ',' + value.slice(-2);
                            this.value = 'R$ ' + value;
                        " 
                        placeholder="R$ 0,00" />
                </div>
                
                <div class="flex justify-end mt-4 space-x-2">
                    <x-secondary-button x-on:click="$dispatch('close-modal', 'add-product-modal')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button id="saveProductBtn" type="button">
                        Adicionar
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Modal para Alteração -->
    <x-modal name="edit-product-modal" :show="false" maxWidth="md">
        <div class="p-6">
            <h2 class="text-lg text-white font-semibold">Editar Produto</h2>
            <form id="editProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="editProductId" name="id">

                <!-- Campo de Upload com Preview -->
                <x-image-input id="editProductImage" name="image" x-ref="imageInput"/>

                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Nome</label>
                    <x-text-input type="text" id="editProductName" name="name" class="w-full" required />
                </div>

                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Descrição</label>
                    <x-textarea-input id="editProductDescription" name="description" class="w-full"></x-textarea-input>
                </div>

                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Preço</label>
                    <x-text-input type="text" id="editProductPrice" name="price" class="w-full" required 
                        value="R$ 0,00"
                        oninput="
                            let value = this.value.replace(/[^0-9]/g, '');
                            value = value ? parseInt(value, 10).toString() : '0';
                            value = value.padStart(3, '0');
                            value = value.slice(0, -2) + ',' + value.slice(-2);
                            this.value = 'R$ ' + value;
                        " 
                        placeholder="R$ 0,00" />
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
    // Verificar existência de parâmetros
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('add_product')) {
            window.dispatchEvent(new CustomEvent('open-modal', { detail: "add-product-modal" }));

            // Remove o parâmetro da URL sem recarregar a página
            const newUrl = window.location.pathname;
            history.replaceState(null, "", newUrl);
        }
    });
    
    // Adicionar Produto
    document.getElementById('saveProductBtn').addEventListener('click', function (e) {
        e.preventDefault();

        let formData = new FormData(document.getElementById('addProductForm'));
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        fetch('/products', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('addProductForm').reset(); // Limpa os campos
                history.replaceState(null, "", window.location.pathname); // Remove o parâmetro
                location.reload(); // Atualiza a página
            } else {
                alert('Erro ao adicionar o produto.');
                console.log(data);
            }
        })
        .catch(error => console.error('Erro ao adicionar produto:', error));
    });

    // Alterar Produto
    function openEditModal(id, name, description, price, imageURL) {
        document.getElementById('editProductId').value = id;
        document.getElementById('editProductName').value = name;
        document.getElementById('editProductDescription').value = description;
        document.getElementById('editProductPrice').value = price;

        // Limpa a imagem de preview antes de abrir o modal
        const imageInput = document.querySelector('[x-ref="imageInput"]');
        if (imageInput) {
            imageInput.dispatchEvent(new CustomEvent('update-image', { detail: '' }));
        }

        window.dispatchEvent(new CustomEvent('open-modal', { detail: "edit-product-modal" }));
    }

    document.getElementById('saveEditProductBtn').addEventListener('click', function (e) {
        e.preventDefault();

        let productId = document.getElementById('editProductId').value;
        let formData = new FormData(document.getElementById('editProductForm'));

        formData.append('_method', 'PUT');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

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
            }
        })
        .catch(error => console.error('Erro ao editar produto:', error));
    });

    // Excluir Produto
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
                location.reload(); // Atualiza a página
            } else {
                alert('Erro ao excluir o produto.');
            }
        })
        .catch(error => console.error('Erro ao excluir produto:', error));
    });
</script>
</x-app-layout>
