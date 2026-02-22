<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Chamados Anônimos')</title>

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased text-slate-900 border-t-4 border-indigo-600">
    <div class="min-h-full flex flex-col">
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 w-full border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-2">
                        <div class="bg-indigo-600 p-2 rounded-lg text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">CHAMADOS<span
                                class="text-indigo-600">ANÔNIMOS</span></span>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="bg-white border-t border-slate-200 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-slate-500 text-sm italic">&copy; {{ date('Y') }} Chamados Anônimos. Sua privacidade é
                    nossa prioridade.</p>
            </div>
        </footer>
    </div>
</body>

</html>