@extends('layout')

@section('title', 'Abrir Novo Chamado - Chamados Anônimos')

@section('content')
<div class="relative overflow-hidden bg-white min-h-[calc(100vh-160px)]">
    <!-- Efeito de Fundo -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 left-0 -translate-y-12 -translate-x-12 blur-3xl opacity-10">
            <div class="w-[30rem] h-[30rem] rounded-full bg-gradient-to-br from-indigo-400 to-blue-400"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('home') }}" class="p-2 rounded-full hover:bg-slate-100 transition-colors text-slate-400 hover:text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Novo Registro</h1>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
            <div class="p-8 sm:p-10">
                <form action="{{ route('chamado.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Tipo de Registro -->
                    <div>
                        <label for="tipo" class="block text-sm font-semibold text-slate-700 mb-2">Tipo de Registro</label>
                        <div class="relative">
                            <select name="tipo" id="tipo" required
                                class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 px-4 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all appearance-none cursor-pointer">
                                <option value="" disabled selected>Selecione o tipo de registro...</option>
                                <option value="Denúncia">Denúncia</option>
                                <option value="Questionamento (LGPD)">Questionamento (LGPD)</option>
                                <option value="Solicitação">Solicitação</option>
                                <option value="Sugestão">Sugestão</option>
                                <option value="Elogio">Elogio</option>
                                <option value="Outros">Outros</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        @error('tipo')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Assunto -->
                    <div>
                        <label for="assunto" class="block text-sm font-semibold text-slate-700 mb-2">Assunto</label>
                        <input type="text" name="assunto" id="assunto" placeholder="Resuma o motivo do seu contato" required
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 px-4 text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        @error('assunto')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descrição -->
                    <div>
                        <label for="descricao" class="block text-sm font-semibold text-slate-700 mb-2">Descrição Detalhada</label>
                        <textarea name="descricao" id="descricao" rows="6" placeholder="Descreva aqui sua solicitação com o máximo de detalhes possível..." required
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 px-4 text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all resize-none"></textarea>
                        @error('descricao')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botão de Envio -->
                    <div class="pt-4">
                        <button type="submit" 
                            class="w-full flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 shadow-lg shadow-indigo-200 hover:-translate-y-1">
                            <span class="text-lg">Enviar Registro Seguro</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                        <p class="text-center text-xs text-slate-400 mt-4 flex items-center justify-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Sua conexão e relato são protegidos por criptografia.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
