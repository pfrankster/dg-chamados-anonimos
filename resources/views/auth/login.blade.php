@extends('layout')

@section('title', 'Login Administrativo - Chamados Anônimos')

@section('content')
<div class="relative min-h-[calc(100vh-160px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-indigo-500/5 blur-3xl"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] rounded-full bg-blue-500/5 blur-3xl"></div>
    </div>

    <div class="relative z-10 max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Área de Gestão</h1>
            <p class="mt-2 text-slate-500 font-medium">Acesse com suas credenciais de administrador ou atendente</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="p-8 sm:p-10">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">E-mail Corporativo</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 px-4 text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Senha</label>
                        <input type="password" name="password" id="password" required
                            class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3 px-4 text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded transition-all cursor-pointer">
                            <label for="remember_me" class="ml-2 block text-sm text-slate-600 cursor-pointer">Lembrar acesso</label>
                        </div>
                    </div>

                    <button type="submit" 
                        class="w-full flex justify-center items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 shadow-lg shadow-slate-200 hover:-translate-y-0.5">
                        <span class="text-lg">Entrar no Painel</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
            
            <div class="bg-slate-50 border-t border-slate-100 p-6 text-center">
                <p class="text-sm text-slate-500">Esqueceu sua senha? Entre em contato com o suporte de TI.</p>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}" class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Voltar ao Início
            </a>
        </div>
    </div>
</div>
@endsection
