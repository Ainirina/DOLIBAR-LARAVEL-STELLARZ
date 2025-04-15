@vite('resources/css/menu.css')
@vite('resources/js/menu.js')

@php
use App\Helpers\MenuHelper;

$menuItems = [
    [
        'title' => 'Dashboard',
        'icon' => 'pi-home',
        'route' => 'dashboard',
        'active' => 'dashboard',
        'activate' => false,
    ],
    [
        'title' => 'Shop',
        'icon' => 'pi-shop',
        'submenu' => [
            [
                'title' => 'Element',
                'icon' => 'pi-th-large',
                'submenu' => [
                    [
                        'title' => 'List',
                        'icon' => 'pi-list',
                        'route' => 'products.index',
                        'active' => 'elements',
                        'activate' => false,
                    ],
                    [
                        'title' => 'Create',
                        'icon' => 'pi-objects-column',
                        'route' => 'products.create',
                        'active' => 'create',
                        'activate' => false,
                    ],
                ]
            ],
            [
                'title' => 'Orders',
                'icon' => 'pi-shopping-bag',
                'route' => 'dashboard',
                'active' => 'orders',
                'activate' => false,
            ],
            [
                'title' => 'Customers',
                'icon' => 'pi-users',
                'route' => 'dashboard',
                'active' => 'customers',
                'activate' => false,
            ],
        ],
    ],
    [
        'title' => 'Blog',
        'icon' => 'pi-inbox',
        'submenu' => [
            [
                'title' => 'Post',
                'icon' => 'pi-file',
                'route' => 'dashboard',
                'active' => 'posts',
                'activate' => false,
            ],
            [
                'title' => 'Categories',
                'icon' => 'pi-folder-open',
                'route' => 'dashboard',
                'active' => 'category',
                'activate' => false,
            ],
            [
                'title' => 'Authors',
                'icon' => 'pi-home',
                'route' => 'dashboard',
                'active' => 'authors',
                'activate' => false,
            ],
            [
                'title' => 'Links',
                'icon' => 'pi-link',
                'route' => 'dashboard',
                'active' => 'links',
                'activate' => false,
            ],
        ],
    ],
];

$menuItems = MenuHelper::updateMenu($menuItems);
@endphp

<aside class="fixed inset-y-0 start-0 z-30 flex flex-col h-screen content-start bg-[--Black] transition-all dark:bg-gray-900 lg:z-0 lg:bg-transparent lg:shadow-none lg:ring-0 lg:transition-none dark:lg:bg-transparent lg:translate-x-0 rtl:lg:-translate-x-0 fi-main-sidebar w-72 -translate-x-full rtl:translate-x-full lg:sticky">
    <div class="overflow-x-clip">
        <header class="sticky top-0 z-50 flex w-full border-b border-gray-200 bg-[--Black] dark:border-gray-800 dark:bg-gray-900">
            <div class="flex w-full items-center justify-between px-4 py-4">
                <!-- Logo -->
                <div class="w-10 h-10 flex sm:justify-center items-center fill-current">
                    <x-ApplicationLogo class="h-20 text-[--Primary] w-200"  />
                </div>
            </div>
        </header>
    </div>
    <nav class="flex-grow flex flex-col gap-y-7 overflow-y-auto overflow-x-hidden px-6 py-8">
        <ul class=" -mx-2 flex flex-col gap-y-7">
            @foreach ($menuItems as $item)
                <li class="flex flex-col gap-y-1">
                    <ul class="flex flex-col gap-y-1">
                            @if (isset($item['route']))
                                <x-ItemButton :menu="$item" />
                            @endif
                            @if (isset($item['submenu']))
                                <x-SubMenu :menu="$item" />
                            @endif
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
</aside>
