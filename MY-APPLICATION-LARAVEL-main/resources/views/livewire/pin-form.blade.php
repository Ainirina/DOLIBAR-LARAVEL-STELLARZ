<div class="bg-white dark:bg-gray-800 flex flex-col items-center w-80 text-center p-6 rounded-lg shadow-md">
    <h2 class="text-lg font-semibold mb-4">Enter your PIN code for administration</h2>
    <form id="pinForm" method="POST" action="{{ route('admin-Login.post') }}">
        @csrf
        <input type="hidden" id="pin_code" name="pin_code" wire:model="pin_code">
        <div class="flex space-x-2 justify-center">
            @foreach (range(1, 4) as $i)
                <input 
                    id="pin{{ $i }}"
                    class="w-12 h-12 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    type="text" 
                    maxlength="1"
                    wire:model="input.{{ $i-1 }}"
                    wire:input="updatePin({{ $i-1 }}, $event.target.value)"
                    placeholder="0"
                    autofocus="{{ $i == 1 ? 'autofocus' : '' }}"
                >
            @endforeach
        </div>
    </form>

    @error('pin_code')
        <div class="text-red-700 px-4 py-3 relative mb-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @enderror

    @if ($message)
        <div class="text-gray-400 px-4 py-3 relative mb-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif

    <script>
        window.addEventListener('focusNextInput', event => {
            let nextInput = document.getElementById("pin" + (event.detail.index + 1));
            if (nextInput) {
                nextInput.focus();
            }
        });

        window.addEventListener('focusPreviousInput', event => {
            let previousInput = document.getElementById("pin" + (event.detail.index + 1));
            if (previousInput) {
                previousInput.focus();
            }
        });

        window.addEventListener('submitPIN', () => {
            let form = document.getElementById("pinForm");
            if (form) form.submit();
        });
    </script>
</div>