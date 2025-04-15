@php
use App\Helpers\MenuHelper;

$menuItems = [
    [
        'title' => 'Products',
        'icon' => 'pi-bolt',
        'route' => 'products.index',
        'active' => 'products',
        'activate' => false,
    ],
    [
        'title' => 'Categories',
        'icon' => 'pi-tag',
        'route' => 'categories.index',
        'active' => 'categories',
        'activate' => false,
    ],
    [
        'title' => 'Brands',
        'icon' => 'pi-verified',
        'route' => 'home',
        'active' => 'home',
        'activate' => false,
    ],
];

$menuItems = MenuHelper::updateMenu($menuItems);
@endphp


<div class="fi-page-sub-navigation-sidebar-ctn hidden w-72 flex-col gap-y-8 md:flex">
    <div>
        <h1 class="capitalize fi-header-heading text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
            @yield('element.active','Elements')
        </h1>
    </div>
    <ul wire:ignore="" class="fi-page-sub-navigation-sidebar flex flex-col gap-y-7">
        <li x-data="{ label: 'sub_navigation_' }" data-group-label="sub_navigation_"
            class="fi-sidebar-group flex flex-col gap-y-1 fi-active">
            <ul class="fi-sidebar-group-items flex flex-col gap-y-1">
                @foreach ($menuItems as $item)
                <li class="fi-sidebar-item fi-active fi-sidebar-item-active flex flex-col gap-y-1">
                    @if (isset($item['route']))
                        <x-ItemButton :menu="$item" />
                    @endif
                </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>