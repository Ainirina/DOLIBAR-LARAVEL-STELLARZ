@if (isset($menu))
    <div
        class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-4 py-2 outline-none transition duration-75 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5">
        @if (isset($menu['icon']))
            <p class="pi {{ $menu['icon'] }}"></p>
        @endif
        @if (isset($menu['title']))
        <span class="fi-sidebar-group-label flex-1 text-sm font-medium leading-6 text-gray-500 dark:text-gray-400">
            {{ $menu['title'] }}
        </span>
        @endif
        <button
            class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray fi-sidebar-group-collapse-button">
            <p class="pi pi-angle-up"></p>
        </button>
    </div>
    <ul class="ml-4 submenu">
        @foreach ($menu['submenu'] as $sub)
            <li>
                @if (isset($sub['route']))
                    <x-ItemButton :menu="$sub" />
                @endif
                @if (isset($sub['submenu']))
                    <x-SubMenu :menu="$sub" />
                @endif
            </li>
        @endforeach
    </ul>
@endif
