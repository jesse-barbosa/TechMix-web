<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TechMix</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/logo.png') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-black text-white">
        <div class="flex justify-center">
            <header class="fixed bg-neutral-900 rounded-sm w-full z-50 top-4 flex justify-between max-w-7xl mx-auto items-center gap-2 px-6 h-16 shadow-xl">
                <div class="flex lg:justify-center lg:col-start-2">
                    <img src="{{ asset('/assets/images/logo.png') }}" alt="TechMix" height="62" width="62">
                </div>
                <nav class="mx-3 flex flex-1 justify-end">
                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-md px-4 py-2 ring-1 ring-transparent transition hover:text-white/80 focus:outline-none focus-visible:ring-white"
                    >
                    Entrar
                    </a>

                    <a
                        href="{{ url('/register') }}"
                        class="border border-yellow-500 rounded-md flex items-center justify-center px-2 ring-1 ring-transparent transition text-yellow-500 hover:bg-yellow-500 hover:text-white/80 focus:outline-none focus-visible:ring-white font-medium"
                    >
                    Criar Minha Loja
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

            <!-- Benefícios -->
            <section class="py-20 bg-neutral-900">
                <div class="max-w-7xl mx-auto px-6 text-center space-y-12">
                    <h2 class="text-4xl font-bold mb-8">Por que escolher o TechMix?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach([
                            ['Fácil de Usar', 'Interface simples e intuitiva que permite gerenciar sua loja de forma rápida, sem complicação.'],
                            ['Gestão Completa', 'Organize seus produtos, atenda seus clientes e receba avaliações de forma prática.'],
                            ['Marketing Integrado', 'Ferramentas para impulsionar sua loja e alcançar mais clientes.']
                        ] as [$titulo, $descricao])
                        <div class="relative group overflow-hidden bg-neutral-800 p-8 rounded-lg transition-all duration-300 hover:scale-105">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500 bg-gradient-to-tr from-yellow-500/20 to-yellow-500/5 blur-xl animate-pulse"></div>
                            <h3 class="text-2xl font-semibold mb-4 text-yellow-500 relative z-10">{{ $titulo }}</h3>
                            <p class="text-neutral-400 relative z-10">{{ $descricao }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- FAQ -->
            <section class="py-20 bg-black">
                <div class="max-w-5xl mx-auto px-6 space-y-12">
                    <h2 class="text-4xl font-bold text-center mb-8">Perguntas Frequentes</h2>
                    <div class="space-y-6">
                    @foreach([
                        ['Preciso pagar para criar minha loja?', 'Você pode começar gratuitamente. Planos pagos estão disponíveis com recursos extras.'],
                        ['Como posso atender meus clientes?', 'Nosso app possui Chat aberto que funciona em sincronia entre lojas e usuários.'],
                        ['Como posso gerenciar meu estoque?', 'Você pode gerenciar seu estoque diretamente pelo painel de controle da sua loja, onde é possível adicionar, editar ou remover produtos.'],
                        ['Posso anuncar minhas redes sociais na minha loja?', 'Sim, você pode adicionar redes sociais e perfis na sua página para aumentar sua visibilidade.'],
                        ['Posso personalizar minha loja?', 'Sim, você pode adicionar descrição, logo, e muito mais para criar um e-commerce chamativo e amigável.'],
                        ] as [$pergunta, $resposta])
                        <div x-data="{ open: false }" class="border-b border-neutral-700 py-4">
                            <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                                <span class="text-xl font-semibold text-neutral-300">{{ $pergunta }}</span>
                                <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-yellow-500 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" x-transition class="text-neutral-400 mt-6 mb-2">
                                {{ $resposta }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="py-20 bg-black">
                <div class="max-w-7xl mx-auto px-6 text-center space-y-12">
                    <h2 class="text-4xl font-bold mb-8">Funciona em Qualquer Dispositivo</h2>
                    <p class="text-neutral-400 max-w-2xl mx-auto">Seja no computador, tablet ou celular, sua loja sempre pronta para impressionar clientes.</p>
                    <img src="{{ asset('/assets/images/devices-frame.png') }}" alt="TechMix responsive" class="mx-auto mt-10">
                </div>
            </section>

            <section class="py-20 bg-neutral-900">
                <div class="max-w-7xl mx-auto px-6 text-center space-y-16">
                    <h2 class="text-4xl font-bold text-white">Como Criar Sua Loja</h2>
                    <div class="flex flex-wrap justify-center gap-10">
                        <!-- Etapa 1: Crie sua conta -->
                        <div class="hover:bg-neutral-700 cursor-pointer transition-all flex flex-col items-center w-72 h-80 bg-neutral-800 shadow-lg py-10 px-7 space-y-4 relative overflow-hidden text-center rounded-2xl">
                            <div class="w-20 h-20 bg-yellow-500 rounded-full absolute -right-5 -top-6 flex items-center justify-center text-white text-2xl font-bold shadow-md">1</div>
                            <i class="material-icons text-yellow-500 text-5xl">store</i>
                            <h3 class="font-bold text-xl text-white">Crie sua conta</h3>
                            <p class="text-sm text-neutral-400 leading-6">Cadastre-se com seu e-mail e comece gratuitamente. Sem necessidade de cartão de crédito.</p>
                        </div>

                        <!-- Etapa 2: Personalize sua loja -->
                        <div class="hover:bg-neutral-700 cursor-pointer transition-all flex flex-col items-center w-72 h-80 bg-neutral-800 shadow-lg py-10 px-7 space-y-4 relative overflow-hidden text-center rounded-2xl">
                            <div class="w-20 h-20 bg-yellow-500 rounded-full absolute -right-5 -top-6 flex items-center justify-center text-white text-2xl font-bold shadow-md">2</div>
                            <i class="material-icons text-yellow-500 text-5xl">brush</i>
                            <h3 class="font-bold text-xl text-white">Personalize sua loja</h3>
                            <p class="text-sm text-neutral-400 leading-6">Adicione sua logo, escolha cores e configure seu catálogo de produtos como preferir.</p>
                        </div>

                        <!-- Etapa 3: Publique e venda -->
                        <div class="hover:bg-neutral-700 cursor-pointer transition-all flex flex-col items-center w-72 h-80 bg-neutral-800 shadow-lg py-10 px-7 space-y-4 relative overflow-hidden text-center rounded-2xl">
                            <div class="w-20 h-20 bg-yellow-500 rounded-full absolute -right-5 -top-6 flex items-center justify-center text-white text-2xl font-bold shadow-md">3</div>
                            <i class="material-icons text-yellow-500 text-5xl">computer</i>
                            <h3 class="font-bold text-xl text-white">Publique e venda</h3>
                            <p class="text-sm text-neutral-400 leading-6">Publique seus produtos e comece a vender compartilhando com seus clientes.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section class="relative py-24 my-16 overflow-hidden">
                <!-- Fundo com ondas -->
                <div class="max-w-7xl mx-auto absolute inset-0 -z-10 bg-neutral-900 rounded-md">
                    <svg class="absolute top-0 left-0 w-full h-full opacity-80" viewBox="0 0 1440 320" preserveAspectRatio="none">
                        <path fill="#facc15" fill-opacity="1" d="M0,160L60,165.3C120,171,240,181,360,181.3C480,181,600,171,720,144C840,117,960,75,1080,74.7C1200,75,1320,117,1380,138.7L1440,160L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path>
                    </svg>
                    <svg class="absolute bottom-0 left-0 w-full h-full opacity-20" viewBox="0 0 1440 320" preserveAspectRatio="none">
                        <path fill="#facc15" fill-opacity="1" d="M0,192L80,186.7C160,181,320,171,480,154.7C640,139,800,117,960,128C1120,139,1280,181,1360,202.7L1440,224L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
                    </svg>
                </div>

                <!-- Conteúdo -->
                <div class="max-w-7xl mx-auto text-center px-6">
                    <h2 class="text-5xl font-extrabold text-white">Crie sua Loja</h2>
                    <p class="mt-4 text-lg text-white w-1/2 mx-auto">Em poucos minutos, você já pode ter seu próprio espaço para vender, divulgar e crescer.</p>
                    <button class="mt-8 px-8 py-4 text-xl font-semibold bg-yellow-500 hover:bg-yellow-600 transition text-black shadow-lg">
                        Comece Agora
                    </button>
                </div>
            </section>
            
        </main>

        <!-- Footer -->
        <footer class="bg-neutral-800 py-12">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-neutral-400 text-sm">
                <div>
                    <img class="mb-4" src="{{ asset('/assets/images/logo.png') }}" alt="TechMix" height="62" width="62">
                    <p>Transformando ideias em negócios digitais.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Links Rápidos</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/dashboard') }}" class="hover:text-white transition">Dashboard</a></li>
                        <li><a href="{{ url('/register') }}" class="hover:text-white transition">Criar Loja</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Contato</h4>
                    <ul class="space-y-2">
                        <li>Email: suporte@techmix.com</li>
                        <li>WhatsApp: (11) 99999-9999</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Redes Sociais</h4>
                    <div class="flex gap-8">
                        <a href="#" class="flex flex-col items-center text-neutral-400 hover:text-white transition">
                            <!-- Ícone Instagram -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M16 8a1 1 0 100-2 1 1 0 000 2z" />
                                <rect width="18" height="18" x="3" y="3" rx="4" ry="4" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            Instagram
                        </a>
                        <a href="#" class="flex flex-col items-center text-neutral-400 hover:text-white transition">
                            <!-- Ícone Facebook -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                            Facebook
                        </a>
                        <a href="#" class="flex flex-col items-center text-neutral-400 hover:text-white transition">
                            <!-- Ícone LinkedIn -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M16 8a6 6 0 016 6v6h-4v-6a2 2 0 00-4 0v6h-4v-6a6 6 0 016-6zM2 9h4v12H2z" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                            LinkedIn
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center text-neutral-500 text-md">
                &copy; 2025 TechMix. Todos os direitos reservados.
            </div>
        </footer>
    </body>
</html>
