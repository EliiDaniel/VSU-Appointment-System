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
    </head>
    <body class="font-sans text-gray-900 antialiased ">
        @if (request()->routeIs('system.logs'))
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
            <div class="min-h-screen min-w-full flex justify-center gap-8 bg-gray-100 dark:bg-gray-900 px-16 pb-6 pt-12">
                <div class="hidden lg:flex justify-center items-center">
                    <x-application-logo maxWidth="2xl" class="w-20 h-20 fill-current text-gray-500" />
                </div>
                <div class="mx-auto max-w-full min-w-[400px] w-full mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        @else
        <div class="min-h-screen min-w-full flex justify-center items-center pt-0 bg-gray-100 dark:bg-gray-900 p-6">
            <div>
                <div>
                    <a href="/" wire:navigate>
                        <x-application-logo maxWidth="2xl" class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>
                    <div class="w-full mx-auto sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">
                        {{ $slot }}
                    </div>
            </div>
        </div>
        @endif
    </body>
</html>
