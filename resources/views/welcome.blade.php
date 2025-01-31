<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TechMix</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/logo.png') }}">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-black text-white">
        <div class="flex justify-center ">
            <header class="fixed w-full z-50 top-0 flex justify-between max-w-7xl mx-auto items-center gap-2 p-4">
                <div class="flex lg:justify-center lg:col-start-2">
                    <img src="{{ asset('/assets/images/logo.png') }}" alt="TechMix" height="64" width="64">
                </div>
                <nav class="-mx-3 flex flex-1 justify-end">
                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-white/80 focus:outline-none focus-visible:ring-white"
                    >
                    Entrar
                    </a>

                    <a
                        href="{{ url('/register') }}"
                        class="rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-white/80 focus:outline-none focus-visible:ring-white"
                    >
                    Cadastrar
                    </a>
                </nav>
            </header>
        </div>
        <main>

            <!-- Hero -->
            <section class="h-screen flex flex-col items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black">
                    <div class="checkered-background"></div>
                </div>
                <div class="max-w-4xl mx-auto text-center relative z-10">
                    <h1 class="text-5xl xl:text-6xl font-bold">Transforme suas <span class="text-yellow-500">ideias</span> em realidade com seu próprio <span class="text-yellow-500">e-commerce</span></h1>
                    <p class="my-4 text-neutral-400">Divulgue seu catálogo, converse com clientes, faça Marketing e impulsione suas vendas</p>
                </div>
            </section>


            <section class="py-5">
                <div class="max-w-7xl mx-auto text-center">
                    <h2 class="text-2xl font-bold">Crie sua Loja</h2>
                    <p class="mt-2">Crie sua loja em poucos minutos e comece a divulgar seus produtos de forma simples e rápida.</p>
                    <button class="mt-4 px-4 py-2 bg-blue-500 rounded-md hover:bg-blue-600 transition">Fale Conosco</button>
                </div>
            </section>
        </main>

        <footer class="flex flex-col items-center justify-center py-12 text-center text-sm text-gray-300">
            TechMix &copy; {{ date('Y') }}. Todos os direitos reservados.
        </footer>
    </body>
</html>
