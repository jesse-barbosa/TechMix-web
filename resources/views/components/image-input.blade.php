@props(['id', 'name', 'preview' => null, 'required' => false])

<div x-data="imagePreview('{{ $preview ?? '' }}')" class="w-full">
    <label class="block text-sm text-neutral-300 mb-2">Imagem do Produto</label>

    <div 
        class="relative border-2 border-dashed border-neutral-600 bg-neutral-800 text-neutral-300 rounded-lg shadow-sm flex flex-col items-center justify-center p-6 cursor-pointer hover:border-yellow-500 transition"
        x-on:dragover.prevent="dragging = true"
        x-on:dragleave.prevent="dragging = false"
        x-on:drop.prevent="handleDrop($event)"
        x-bind:class="{'border-yellow-500 bg-neutral-700': dragging}"
    >
        <input 
            type="file" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            accept="image/*"
            {{ $required ? 'required' : '' }}
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
            x-on:change="previewImage($event)"
        />

        <template x-if="!imageSrc">
            <div class="flex flex-col items-center">
                <i class="material-icons text-4xl text-neutral-400">cloud_upload</i>
                <p class="text-neutral-400 text-sm mt-2">Arraste e solte uma imagem aqui</p>
                <span class="text-sm text-yellow-400 font-medium mt-1">ou clique para selecionar</span>
            </div>
        </template>

        <template x-if="imageSrc">
            <div class="relative">
                <img :src="imageSrc" class="w-40 h-40 object-cover rounded-lg shadow-md">
                <button type="button"
                    class="flex items-center justify-center absolute top-0 right-0 h-8 w-8 bg-red-600 text-white rounded-full shadow-lg hover:bg-red-700 transition"
                    x-on:click="clearImage">
                    <i class="material-icons text-xs">close</i>
                </button>
            </div>
        </template>
    </div>
</div>

<script>
    function imagePreview(initialValue) {
        return {
            imageSrc: initialValue,
            dragging: false,
            
            previewImage(event) {
                const file = event.target.files[0];
                if (!file) return;
                this.loadFile(file);
            },

            handleDrop(event) {
                event.preventDefault();
                this.dragging = false;
                const file = event.dataTransfer.files[0];
                if (!file) return;
                this.loadFile(file);
            },

            loadFile(file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.imageSrc = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            clearImage() {
                this.imageSrc = null;
                document.getElementById("{{ $id }}").value = "";
            }
        }
    }
</script>
