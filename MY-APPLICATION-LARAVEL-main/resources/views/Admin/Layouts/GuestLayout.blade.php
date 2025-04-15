<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @livewireStyles
    @vite(['resources/js/import.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-center selection:bg-gray-300 selection:text-black">
    <header class="p-4flex justify-between">
        <div class="w-20 h-20 flex sm:justify-center items-center fill-current">
            <x-application-logo />
            <h1 class="font-semibold">ADMIN</h1>
        </div>
    </header>

    <main class="p-6">
        @yield('content')
    </main>
    @livewireScripts
</body>
</html>
