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
        <script src="https://unpkg.com/filepond@4.30.0/dist/filepond.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview@4.6.3/dist/filepond-plugin-image-preview.min.js"></script>
        <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">
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
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
                <div>
                    <a href="/" wire:navigate>
                        <x-application-logo maxWidth="2xl" class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>
                <div class="w-full mx-auto {{ request()->routeIs('register') ? '' : 'sm:max-w-md' }} mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg dark:shadow-[rgba(0,0,0,0.5)_0px_0px_200px_10px] dark:shadow-green-600/50">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @endif
    </body>
</html>
