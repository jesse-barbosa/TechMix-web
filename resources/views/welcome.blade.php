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
    <body class="dark:bg-[#1D1D1D] dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <header class="flex justify-between items-center gap-2 p-4">
                <div class="flex lg:justify-center lg:col-start-2">
                    <img src="{{ asset('/assets/images/logo.png') }}" alt="TechMix" height="64" width="64">
                </div>
                <nav class="-mx-3 flex flex-1 justify-end">
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                    Entrar
                    </a>

                    <a
                    href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                    Cadastrar
                    </a>
                </nav>
            </header>

            <main class="mt-6">
                <section class="py-5 text-white">
                    <div class="max-w-7xl mx-auto text-center">
                        <h2 class="text-2xl font-bold">Sobre Nós</h2>
                        <p class="mt-2">Na TechMix, estamos comprometidos em trazer as inovações tecnológicas mais recentes para o seu dia a dia. Nossa missão é conectar você ao futuro.</p>
                    </div>
                </section>

                <section class="py-5">
                    <div class="max-w-7xl mx-auto">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/2">
                            <img src="img/innovation.jpg" class="w-full h-auto" alt="Inovação">
                            </div>
                            <div class="md:w-1/2 mt-4 md:mt-0 md:ml-4">
                                <h2 class="text-2xl font-bold">Inovações Recentes</h2>
                                <p class="mt-2">Descubra como nossas soluções estão transformando indústrias e melhorando vidas. Desde inteligência artificial até a Internet das Coisas, estamos na vanguarda da tecnologia.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-5 text-white">
                    <div class="max-w-7xl mx-auto text-center">
                        <h2 class="text-2xl font-bold">Entre em Contato</h2>
                        <p class="mt-2">Quer saber mais sobre nossos produtos e serviços? Entre em contato conosco e descubra como podemos ajudar você a alcançar seus objetivos tecnológicos.</p>
                        <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">Fale Conosco</button>
                    </div>
                </section>
            </main>

        <footer class="flex flex-col items-center justify-center py-16 text-center text-sm text-black dark:text-gray-300">
            TechMix &copy; {{ date('Y') }}. Todos os direitos reservados.
            <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </a>
        </footer>
        </div>
    </body>
</html>
