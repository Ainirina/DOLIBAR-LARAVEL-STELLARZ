<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/js/import.js'])
    @livewireStyles
</head>

<body class="fi-body fi-panel-admin min-h-screen bg-[#0D0D0D] font-normal text-[#F4F4F4]  antialiased dark:bg-gray-950 dark:text-white">


    <div class="fi-layout flex min-h-screen w-full flex-row-reverse overflow-x-clip bg-[#0D0D0D] font-normal text-[#F4F4F4] ">
        <div class="fi-main-ctn w-screen flex-1 flex-col bg-[#0D0D0D] font-normal text-[#F4F4F4]  ">
            <div class="fi-topbar sticky top-0 z-20 overflow-x-clip bg-[#0D0D0D] font-normal text-[#F4F4F4]  ">
                @include('admin.partials.header')
            </div>
            <main class="fixed bg-[#0D0D0D] font-normal text-[#F4F4F4]  overflow-auto mx-auto h-full w-full px-4 md:px-6 lg:px-8 max-w-[88rem]">
                <div>
                    <section class="flex h-[100000px] bg-[#0D0D0D]  w-[1100px] font-normal text-[#F4F4F4] flex-col gap-y-8 py-8">
                        @yield('content')
                    </section>
                </div>
            </main>
        </div>
        <div x-data="{}" x-on:click="$store.sidebar.close()" x-show="$store.sidebar.isOpen"
            x-transition.opacity.300ms=""
            class="fi-sidebar-close-overlay fixed inset-0 z-30 bg-[#0D0D0D] font-normal text-[#F4F4F4]  transition duration-500 dark:bg-gray-950/75 lg:hidden"
            style="display: none;"></div>
        @include('admin.partials.aside')
    </div>
    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
