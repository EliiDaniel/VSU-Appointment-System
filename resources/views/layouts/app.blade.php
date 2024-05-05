<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @wireUiScripts
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Side Navigation -->
            <div x-data="{ open: false }" class="flex">
                @if (auth()->user()->role !== "confirmation" && !request()->routeIs('profile*'))
                <div class="w-12 xl:w-64 mt-0" @mouseover="open = true" @mouseleave="open = false">
                    <header class="bg-white dark:bg-gray-800 shadow w-12 xl:w-64 hover:w-64 fixed top-[65px] z-10 h-screen hover:px-8 py-6 xl:px-8 transition-all duration-75 ease-in-out overflow-hidden">
                        <livewire:layout.sidenav />
                    </header>
                </div>
                @endif
                <!-- Page Content -->
                <main class="mt-[65px] h-auto {{ auth()->user()->role ? 'flex-1 w-full mx-auto min-w-0 py-6 px-4 sm:px-6 lg:px-8' : '' }}">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
