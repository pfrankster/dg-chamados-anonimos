@extends('layouts.mgmt')

@section('title', 'Dashboard Admin - Chamados Anônimos')

@section('mgmt-content')
<div class="mb-10">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Painel do Administrador</h2>
    <p class="text-slate-500 mt-2">Visão geral do sistema e gestão de acessos.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Card Atendentes -->
    <a href="{{ route('mgmt.admin.atendentes') }}" class="group bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-2xl w-fit mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">Gestão de Atendentes</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Crie, edite e gerencie o acesso das pessoas responsáveis pelo atendimento.</p>
    </a>

    <!-- Card Chamados (Global) -->
    <a href="{{ route('mgmt.chamados') }}" class="group bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
        <div class="bg-blue-100 text-blue-600 p-3 rounded-2xl w-fit mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">Visão Geral de Chamados</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Acompanhe todos os registros de manifestações abertos no sistema.</p>
    </a>

    <!-- Card Configurações (Placehold) -->
    <div class="bg-slate-50 p-8 rounded-3xl border border-dashed border-slate-300 shadow-sm opacity-60">
        <div class="bg-slate-200 text-slate-500 p-3 rounded-2xl w-fit mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <h3 class="text-xl font-bold text-slate-900 mb-2">Relatórios e Configurações</h3>
        <p class="text-slate-500 text-sm leading-relaxed">Em breve: Relatórios dinâmicos e exportação de dados.</p>
    </div>
</div>
@endsection
