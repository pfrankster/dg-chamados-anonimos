@extends('layout')

@section('title', 'Chamado Enviado com Sucesso - Chamados Anônimos')

@section('content')
<div class="relative overflow-hidden bg-white min-h-[calc(100vh-160px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <!-- Efeito de Fundo -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 blur-3xl opacity-10">
            <div class="w-[40rem] h-[40rem] rounded-full bg-gradient-to-tr from-green-300 to-indigo-300"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-2xl w-full text-center">
        <!-- Ícone de Sucesso -->
        <div class="mb-8 flex justify-center">
            <div class="bg-green-100 p-4 rounded-full text-green-600 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 mb-4">Registro Enviado com Sucesso!</h1>
        <p class="text-lg text-slate-600 mb-10">Seu anonimato foi preservado. Guarde as informações abaixo para acompanhar sua solicitação.</p>

        <!-- Alerta de Segurança -->
        <div class="mb-8 p-4 bg-amber-50 border-l-4 border-amber-400 rounded-r-xl text-left">
            <div class="flex gap-3">
                <div class="flex-shrink-0 text-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-amber-800">ATENÇÃO: Ação Necessária</h3>
                    <p class="text-sm text-amber-700 mt-1">Anote ou copie estas credenciais agora. Por segurança, elas nunca serão exibidas novamente e não podem ser recuperadas.</p>
                </div>
            </div>
        </div>

        <!-- Card de Credenciais -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-slate-200 shadow-2xl p-8 sm:p-12 mb-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-left">
                <div class="space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Protocolo (Login)</span>
                    <div class="flex items-center justify-between bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 group">
                        <code class="text-xl font-mono font-bold text-slate-900 tracking-widest leading-none">{{ $login }}</code>
                    </div>
                </div>
                <div class="space-y-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Chave de Segurança</span>
                    <div class="flex items-center justify-between bg-slate-50 border border-slate-100 rounded-xl px-4 py-3">
                        <code class="text-xl font-mono font-bold text-indigo-600 tracking-widest leading-none">{{ $senha }}</code>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ações -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('chamado.consulta') }}" 
                class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 shadow-lg shadow-indigo-200 hover:-translate-y-1">
                <span>Ir para Consulta</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </a>
            <a href="{{ route('home') }}" 
                class="inline-flex items-center justify-center gap-2 bg-white border-2 border-slate-100 hover:border-slate-200 text-slate-600 font-bold py-4 px-8 rounded-2xl transition-all duration-300 hover:bg-slate-50">
                <span>Início</span>
            </a>
        </div>
    </div>
</div>
@endsection
