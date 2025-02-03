<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/logo.png ') }}" sizes="32x32" />
        <title>TechMix</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Ícones -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=forum" />

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
                    <div class="flex justify-between items-center p-4 sm:px-6">
                        {{ $header }}
                        <div class="flex items-center gap-2 font-medium">
                            {{ Auth::user()->name }}
                            <a href="#chat" class="flex">
                                <i class="material-symbols-outlined inline h-5 w-5 text-neutral-800">forum</i>
                            </a>
                        </div>
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
