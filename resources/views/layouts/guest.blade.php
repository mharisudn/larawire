<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @wireUiScripts
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-full tracking-tight">
    <div class="flex min-h-full px-4 sm:px-0">
        <div class="flex flex-1 flex-col justify-center">
            <div class="mx-auto w-full max-w-lg min-h-[340px]">
                <div class="mt-8 p-8 border rounded rounded-xl shadow-lg md:shadow-none">
                    <img class="h-8 w-auto" src="https://auth.anystack.sh/img/emblem.svg" alt="Anystack">
                    <div class="space-y-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    </body>
</html>
