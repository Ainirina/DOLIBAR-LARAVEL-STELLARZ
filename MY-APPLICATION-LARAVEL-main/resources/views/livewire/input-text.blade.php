<div>
    <div class="grid gap-y-2">
        <div class="flex items-center gap-x-3 justify-between">
            <label class="inline-flex items-center gap-x-3" for="{{ $name }}">
                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                    {{ $label ?? 'Nom' }}
                    @if($required)
                        <sup class="text-red-600 font-medium">*</sup>
                    @endif
                </span>
            </label>
        </div>
        <div class="grid auto-cols-fr gap-y-2">
            <div class="flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 ring-gray-950/10 dark:ring-white/20 overflow-hidden">
                <div class="min-w-0 flex-1">
                    <input 
                        class="block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3
                            dark:text-white dark:placeholder:text-gray-500 
                            {{ $disabled ? 'bg-gray-400 dark:bg-gray-700 cursor-not-allowed opacity-50' : '' }}"
                            type="text" 
                            id="{{ $name }}" 
                            name="{{ $name }}" 
                            wire:model="value" 
                            placeholder="{{ $placeholder }}" 
                            {{ $required ? 'required' : '' }} 
                            {{ $disabled ? 'disabled' : '' }}
                    >
                </div>
            </div>
            @error('value') 
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
