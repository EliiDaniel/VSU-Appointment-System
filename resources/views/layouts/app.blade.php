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

        <!-- Web Application Manifest -->
        <link rel="manifest" href="/manifest.json">
        <!-- Chrome for Android theme color -->
        <meta name="theme-color" content="#000000">

        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="application-name" content="PWA">
        <link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">

        <!-- Add to homescreen for Safari on iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="PWA">
        <link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

        <link href="/images/icons/splash-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-750x1334.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1242x2208.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-828x1792.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1242x2688.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1536x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1668x2224.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-1668x2388.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="/images/icons/splash-2048x2732.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

        <!-- Tile for Win8 -->
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">

        <script type="text/javascript">
            // Initialize the service worker
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/serviceworker.js', {
                    scope: '.'
                }).then(function (registration) {
                    // Registration was successful
                    console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
                }, function (err) {
                    // registration failed :(
                    console.log('Laravel PWA: ServiceWorker registration failed: ', err);
                });
            }
        </script>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @wireUiScripts
        @laravelPWA
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 relative overflow-hidden">
            <div class="absolute top-14 -right-20 -translate-x-6 -translate-y-6 animate-pulse animate-infinite animate-duration-[2500ms] animate-ease-in-out">
                <div class="w-28 md:w-36 h-28 md:h-36 bg-gradient-to-br from-emerald-900 to-emerald-500 rounded-full animate-updown shadow-[rgba(0,0,0,0.5)_0px_0px_200px_10px] dark:shadow-green-600"></div>
            </div>
            <div class="absolute -bottom-16 {{request()->routeIs('waiting-for-confirmation') || request()->routeIs('profile')? '-left-8' : 'left-12 xl:left-60' }} -translate-x-6 -translate-y-6 animate-pulse animate-infinite animate-duration-[2500ms] animate-ease-in-out">
                <div class="w-28 md:w-36 h-28 md:h-36 bg-gradient-to-br from-emerald-900 to-emerald-500 rounded-full animate-updown shadow-[rgba(0,0,0,0.5)_0px_0px_200px_10px] dark:shadow-green-600"></div>
            </div>
            <livewire:layout.navigation />

            <!-- Page Side Navigation -->
            <div x-data="{ open: false }" class="flex">
                @if (auth()->user()->role !== "confirmation" && !request()->routeIs('profile*'))
                <div class="w-12 xl:w-64 mt-0" @mouseover="open = true" @mouseleave="open = false">
                    <header class="bg-white dark:bg-gray-800 w-12 xl:w-64 hover:w-64 fixed top-[65px] z-[40] h-screen hover:px-8 py-6 xl:px-8 transition-all duration-75 ease-in-out overflow-hidden shadow-[rgba(0,0,0,0.5)_-10px_-20px_40px_0px] shadow-green-500/50">
                        <livewire:layout.sidenav />
                    </header>
                </div>
                @endif
                <!-- Page Content -->

                <main class="relative mt-[65px] h-auto {{ auth()->user()->role ? 'flex-1 w-full mx-auto min-w-0 py-6 px-4 sm:px-6 lg:px-8' : '' }}">
                    {{ $slot }}
                </main>

                <div wire:ignore>
                    <x-notifications />
                    <x-dialog z-index="z-50" blur="xs" align="center" />
                </div>
            </div>
        </div>
    </body>
</html>
