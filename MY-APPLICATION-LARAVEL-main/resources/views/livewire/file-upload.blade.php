<div class="space-y-4">
    <div class="border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg p-6 text-center cursor-pointer hover:border-gray-600 hover:dark:border-gray-400 transition duration-200"
         x-data="{ isDragging: false }"
         x-on:drop.prevent="isDragging = false; $wire.upload('file', $event.dataTransfer.files[0])"
         x-on:dragover.prevent="isDragging = true"
         x-on:dragleave.prevent="isDragging = false"
         :class="{ 'border-gray-400': isDragging }">
        <input type="file" wire:model="file" id="{{ $name }}" name="{{ $name }}" accept="{{ $accept }}" class="hidden">
        <label for="{{ $name }}" class="block text-sm font-medium">
            <span class="text-blue-600">Drag  & Drop</span> your file or <span class="text-blue-600">Browse</span>
        </label>
    </div>

    @if ($uploadStatus === 'uploading')
        <div class="mt-4 text-center">
            <p class="text-sm ">{{ $uploadMessage }}</p>
            <button wire:click="resetFile" class="text-blue-500 hover:text-blue-700 text-sm mt-2">
                Annuler
            </button>
        </div>
    @endif

    @if ($file)
        <div class="mt-4">
            @if ($fileType === 'image' && $preview)
                <img src="{{ $preview }}" alt="Preview" class="max-w-full h-auto rounded-lg shadow-sm">
            {{-- @else --}}
                <div class="flex items-center justify-between bg-gray-100 p-3 rounded-lg">
                    <span class="text-sm text-gray-700">{{ $file->getClientOriginalName() }}</span>
                    <button wire:click="resetFile" class="text-red-500 hover:text-red-700">
                        <p class="pi pi-times"></p>
                    </button>
                </div>
            @endif
        </div>
    @endif

    @error('file')
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>