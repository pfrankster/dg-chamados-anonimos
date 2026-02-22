@extends('layout')

@section('title', 'Consultar Chamado - Chamados Anônimos')

@section('content')
<div class="relative overflow-hidden bg-white min-h-[calc(100vh-160px)]">
    <!-- Efeito de Fundo -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 translate-y-[-40%] translate-x-[30%] blur-3xl opacity-10">
            <div class="w-[35rem] h-[35rem] rounded-full bg-gradient-to-br from-indigo-400 to-violet-400"></div>
        </div>
        <div class="absolute bottom-0 left-0 translate-y-[40%] translate-x-[-30%] blur-3xl opacity-10">
            <div class="w-[25rem] h-[25rem] rounded-full bg-gradient-to-tr from-blue-400 to-cyan-400"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
        <!-- Header -->
        <div class="text-center mb-10 animate-in fade-in slide-in-from-bottom-4 duration-500">
            <div class="inline-flex items-center justify-center h-16 w-16 rounded-2xl bg-indigo-100 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">Consultar Chamado</h1>
            <p class="text-slate-500 mt-3 text-sm max-w-md mx-auto">Informe o protocolo e a chave de segurança que foram gerados na abertura do seu chamado.</p>
        </div>

        <!-- Card do Formulário -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-slate-200 shadow-xl overflow-hidden animate-in fade-in slide-in-from-bottom-6 duration-700">
            <div class="p-8 sm:p-10">
                <form action="{{ route('chamado.buscar') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Protocolo -->
                    <div>
                        <label for="login" class="block text-sm font-semibold text-slate-700 mb-2">Protocolo de Acesso</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </div>
                            <input type="text" name="login" id="login" required maxlength="8" placeholder="Ex: aB3dEf9H"
                                class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 pl-12 pr-4 text-slate-900 font-mono tracking-widest text-lg placeholder:text-slate-300 placeholder:tracking-widest focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        </div>
                        @error('login')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Chave de Segurança -->
                    <div>
                        <label for="senha" class="block text-sm font-semibold text-slate-700 mb-2">Chave de Segurança</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="senha" id="senha" required maxlength="8" placeholder="••••••••"
                                class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 pl-12 pr-4 text-slate-900 font-mono tracking-widest text-lg placeholder:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        </div>
                        @error('senha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mensagem de Erro Global -->
                    @if ($errors->has('message'))
                        <div class="flex items-center gap-3 p-4 rounded-2xl bg-red-50 border border-red-100 text-sm text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium">{{ $errors->first('message') }}</span>
                        </div>
                    @endif

                    <!-- Botão -->
                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 shadow-lg shadow-indigo-200 hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="text-lg">Buscar Chamado</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer do Card -->
            <div class="px-8 sm:px-10 py-5 bg-slate-50/80 border-t border-slate-100">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-400">
                    <a href="{{ route('home') }}" class="flex items-center gap-1.5 font-semibold hover:text-indigo-600 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Voltar ao Início
                    </a>
                    <a href="{{ route('chamado.create') }}" class="flex items-center gap-1.5 font-semibold hover:text-indigo-600 transition-colors">
                        Ainda não tem um protocolo?
                        <span class="text-indigo-600 underline">Abrir Chamado</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Dica de Segurança -->
        <p class="text-center text-xs text-slate-400 mt-8 flex items-center justify-center gap-1.5 animate-in fade-in duration-1000">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Consulta protegida. Seus dados são tratados com total sigilo.
        </p>
    </div>
</div>
@endsection
