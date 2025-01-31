<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TechMix</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/logo.png ') }}" sizes="32x32" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Ícones -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>
    <body class="font-sans antialiased" x-data="{ expanded: false }">
        <div class="flex min-h-screen bg-neutral-900">
            <div :class="expanded ? 'flex-none w-1/8 transition-all duration-300' : 'flex-none w-16 transition-all duration-300'">
                @include('layouts.navigation')
            </div>

            <div class="flex-1">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-neutral-100 shadow">
                    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
