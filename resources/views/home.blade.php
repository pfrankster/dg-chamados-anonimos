@extends('layout')

@section('title', 'Boas-vindas - Chamados Anônimos')

@section('content')
<div class="relative overflow-hidden bg-white">
    <!-- Efeito de Fundo -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 -translate-y-12 translate-x-12 blur-3xl opacity-20">
            <div class="w-[40rem] h-[40rem] rounded-full bg-gradient-to-br from-indigo-400 to-purple-400"></div>
        </div>
        <div class="absolute bottom-0 left-0 translate-y-12 -translate-x-12 blur-3xl opacity-20">
            <div class="w-[30rem] h-[30rem] rounded-full bg-gradient-to-tr from-blue-400 to-indigo-300"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-6xl mb-6">
                Sua voz importa, sua <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">identidade não.</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-slate-600 max-w-2xl mx-auto">
                Registrar denúncias, questionamentos sobre a LGPD ou qualquer solicitação agora é 100% seguro e confidencial. 
                Nenhuma informação pessoal é coletada.
            </p>
            
            <div class="mt-12 p-1 bg-white/40 backdrop-blur-xl rounded-3xl border border-white/50 shadow-2xl max-w-3xl mx-auto">
                <div class="bg-white/80 rounded-[1.4rem] p-8 sm:p-12">
                    <h2 class="text-xl font-semibold text-slate-800 mb-8">Escolha uma opção para começar</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pb-2">
                        <a href="{{ route('chamado.create') }}" 
                           class="group relative flex flex-col items-center justify-center p-8 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl transition-all duration-300 shadow-xl hover:shadow-indigo-200 hover:-translate-y-1">
                            <div class="bg-white/20 p-4 rounded-xl mb-4 group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="text-lg font-bold">Abrir Novo Chamado</span>
                            <span class="text-sm text-indigo-100 mt-2 opacity-80">Rápido e totalmente anônimo.</span>
                        </a>

                        <a href="{{ route('chamado.consulta') }}" 
                           class="group relative flex flex-col items-center justify-center p-8 bg-white border-2 border-slate-100 hover:border-indigo-100 hover:bg-slate-50 text-slate-700 rounded-2xl transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1">
                            <div class="bg-slate-100 p-4 rounded-xl mb-4 group-hover:scale-110 transition-transform group-hover:bg-indigo-50 group-hover:text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <span class="text-lg font-bold">Consultar Chamado</span>
                            <span class="text-sm text-slate-500 mt-2 opacity-80">Acompanhe com seu protocolo.</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-left max-w-5xl mx-auto">
                <div class="flex gap-4">
                    <div class="flex-shrink-0 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900">Privacidade Garantida</h3>
                        <p class="text-sm text-slate-500 mt-1">Criptografia de ponta a ponta em todos os relatos.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900">Resposta Ágil</h3>
                        <p class="text-sm text-slate-500 mt-1">Nossa equipe analisa cada caso com rapidez e ética.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09a13.916 13.916 0 002.522-8.113V11.083c0-2.477.399-4.913 1.147-7.222m1.332 0A13.988 13.988 0 0115.148 11h.03a13.977 13.977 0 012.355 7.152l.054.09m-4.276-2.146l.08.067a2.89 2.89 0 005.158-1.558l.192-1.152a2.89 2.89 0 00-5.18-2.31l-.117.154m-2.112 2.112l1.332-1.332" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-900">Zero Rastreamento</h3>
                        <p class="text-sm text-slate-500 mt-1">Nenhum dado de IP ou cookies de rastreio são armazenados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
