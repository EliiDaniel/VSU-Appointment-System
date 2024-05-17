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
        <script src="https://unpkg.com/filepond@4.30.0/dist/filepond.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview@4.6.3/dist/filepond-plugin-image-preview.min.js"></script>
        <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @wireUiScripts
    </head>
    <body class="antialiased">
        
        <div class="relative flex justify-center items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-emerald-500 selection:text-white">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif

            <livewire:welcome :tracking-number="$trackingCode ? $trackingCode : null"/>

            @if (session('status'))
                <div
                    wire:ignore
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 4000)"
                    class="fixed top-4 right-4 bg-green-300 text-gray-700 dark:bg-green-700 dark:text-gray-300 pl-3 pr-20 py-3 rounded-lg z-50 opacity-75 hover:opacity-100 ease-in-out duration-200"
                    role="alert"
                >
                    <span class="block sm:inline tracking-widest font-extrabold text-sm">{{ __(session('status')) }}</span>
                    <span class="absolute top-0 bottom-0 right-0 pt-[9.80px] pr-3 cursor-pointer" @click="show = false">
                        <svg class="fill-current h-6 w-5 text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 1.697l-2.651-2.65-2.65 2.65a1.2 1.2 0 1 1-1.697-1.697l2.65-2.651-2.65-2.65a1.2 1.2 0 1 1 1.697-1.697l2.651 2.65 2.65-2.65a1.2 1.2 0 1 1 1.697 1.697l-2.65 2.651 2.65 2.65z"/></svg>
                    </span>
                </div>
            @endif
        </div>
    </body>
</html>
