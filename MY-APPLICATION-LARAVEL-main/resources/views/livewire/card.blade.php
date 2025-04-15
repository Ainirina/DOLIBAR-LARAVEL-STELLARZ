<section class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">

    {{-- <div class="flex items-center gap-2">
        <label class="relative inline-flex items-center cursor-pointer">
            <!-- Utilisez wire:model pour lier directement l'état de la case à cocher à la propriété visible -->
            <input type="checkbox" wire:model="visible" class="peer">
            <div class="w-11 h-6 bg-gray-200 dark:bg-gray-700 rounded-full peer-checked:bg-yellow-500 transition"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-white">
                {{ $visible ? 'Visible' : 'Hidden' }}
            </span>
        </label>
    </div> --}}

    @if ($header)
    <div>
        {{ $header }}
    </div>
    @endif

    <header class="flex flex-col gap-3 px-6 py-4 border-b border-gray-200 dark:border-white/10">
        <div class="flex items-center gap-3">
            <div class="grid flex-1 gap-y-1">
                @if ($title)
                    <h3 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        {{ $title }}
                    </h3>
                @endif
                @if ($subtitle)
                    <h4 class="text-gray-600 dark:text-gray-300">
                        {{ $subtitle }}
                    </h4>
                @endif
            </div>
        </div> 
    </header>

    <div class="p-6">
        <div class="grid gap-6">
            {{ $content }}
        </div>
    </div>

    @if ($footer)
        <footer>
            <div class="p-6">
                <div class="grid gap-6">
                    {{ $footer }}
                </div>
            </div>
        </footer>
    @endif
</section>
