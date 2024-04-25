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
        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-4/6">
            <div class="mx-auto sm:px-6 lg:px-8 h-full pt-16">
                <div class="bg-white h-full dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center items-center">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Congratulations! Your payment has been successfully processed. Thank you for your purchase. If you have any questions regarding your order or need assistance, feel free to reach out to our support team.<br><br><span class="text-lg">This page will automatically close in 5 seconds. . .</span></h3>
                    </div>
                </div>
            </div>
        </div>

        <script>
            setTimeout(() => { window.close(); }, 5000);
        </script>
    </body>
</html>