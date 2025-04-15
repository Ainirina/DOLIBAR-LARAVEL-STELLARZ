@if (isset($menu))
    <a href="{{ route($menu['route'] ?? '#') }}"
       class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3
       rounded-lg px-4 py-2 outline-none transition duration-75 
       {{ isset($menu['activate']) && $menu['activate'] ? 'bg-gray-950 text-white dark:text-black dark:bg-gray-100 font-semibold' : 'text-gray-500 hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5' }}"
    >
        @if (isset($menu['icon']))
            <p class="pi {{ $menu['icon'] }}"></p>
        @endif
        <span class="fi-sidebar-group-label flex-1 text-sm font-medium leading-6">
            {{ $menu['title'] }}
        </span>
    </a>
@endif
