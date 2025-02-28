<x-app-layout>
    <x-slot name="header">
        <h2 class="font-medium text-xl text-neutral-800">
            {{ __('Produtos') }}
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
                <div class="bg-neutral-800 text-neutral-300 p-6 rounded-lg shadow-md flex flex-col items-center justify-center">
                    <i class="material-icons text-6xl text-neutral-500 mb-4">inventory_2</i>
                    <p class="text-lg font-semibold">Nenhum produto encontrado</p>
                    <p class="text-sm text-neutral-400 mt-2">Parece que você ainda não adicionou nenhum produto ao seu catálogo.</p>
                    <x-primary-button x-on:click="$dispatch('open-modal', 'add-product-modal')" class="mt-4 text-neutral-800">
                        Adicionar Produto
                    </x-primary-button>
                </div>
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
                                onclick='openEditModal({{ $product->id }}, {!! json_encode($product->name) !!}, {!! json_encode($product->description) !!}, {!! json_encode($product->price) !!}, {!! json_encode($product->imageURL) !!}, {!! json_encode($product->categoryId) !!})'>
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
                    <label class="text-sm text-neutral-300">Categoria</label>
                    <select id="productCategory" name="categoryId" class="w-full border-neutral-700 bg-neutral-900 text-white border p-2 rounded-md">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
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
                    <label class="text-sm text-neutral-300">Categoria</label>
                    <select id="editProductCategory" name="categoryId" class="w-full border-neutral-700 bg-neutral-900 text-white border p-2 rounded-md">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label class="text-sm text-neutral-300">Preço</label>
                    <x-text-input type="text" id="editProductPrice" name="price" class="w-full" required 
                        value="R$ 0,00"
                        oninput="
                            let value = this.value.replace(/[^0-9]/g, ''); // Remove qualquer caractere que não seja número
                            value = value ? parseInt(value, 10).toString() : '0'; // Converte para número
                            value = value.padStart(3, '0'); // Preenche com zero à esquerda se necessário
                            value = value.slice(0, -2) + ',' + value.slice(-2); // Adiciona vírgula para centavos
                            this.value = 'R$ ' + value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); // Formata o valor com pontos para milhar
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

        // Manipula o preço antes de adicionar no FormData
        let price = document.getElementById('productPrice').value
            .replace('R$ ', '')   // Remove "R$ "
            .replace('.', '')     // Remove ponto (milhar)
            .replace(',', '.');   // Substitui a vírgula por ponto

        formData.append('price', price); // Adiciona o preço no formato correto ao FormData

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
        .catch(error => console.error('Erro ao adicionar produto:', error) );
    });

    // Alterar Produto
    function openEditModal(id, name, description, price, imageURL, categoryId) {
        document.getElementById('editProductId').value = id;
        document.getElementById('editProductName').value = name;
        document.getElementById('editProductDescription').value = description;
        document.getElementById('editProductCategory').value = categoryId;

        // Formatar o preço para o formato R$ 1.000,00
        let formattedPrice = (parseFloat(price) || 0).toFixed(2).replace('.', ',');
        formattedPrice = formattedPrice.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); // Aplica o ponto para milhar

        // Atribui o preço formatado ao campo de preço
        document.getElementById('editProductPrice').value = `R$ ${formattedPrice}`;

        // Limpa a imagem de preview antes de abrir o modal
        const imageInput = document.querySelector('[x-ref="imageInput"]');
        if (imageInput) {
            imageInput.dispatchEvent(new CustomEvent('update-image', { detail: '' }));
        }

        window.dispatchEvent(new CustomEvent('open-modal', { detail: "edit-product-modal" }));
    }

    // Salvando os dados do produto
    document.getElementById('saveEditProductBtn').addEventListener('click', function (e) {
        e.preventDefault();

        let productId = document.getElementById('editProductId').value;
        let formData = new FormData(document.getElementById('editProductForm'));

        // Manipula o preço antes de adicionar no FormData
        let price = document.getElementById('editProductPrice').value
            .replace('R$ ', '')   // Remove "R$ "
            .replace('.', '')     // Remove ponto (milhar)
            .replace(',', '.');   // Substitui a vírgula por ponto

        formData.append('price', price); // Adiciona o preço no formato correto ao FormData

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
