@extends('layouts.mgmt')

@section('title', 'Meus Atendimentos - Chamados Anônimos')

@section('mgmt-content')
<div class="mb-10">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Painel de Atendimento</h2>
    <p class="text-slate-500 mt-2">Bem-vindo! Aqui estão as manifestações que aguardam retorno.</p>
</div>

<div class="bg-indigo-600 rounded-3xl p-8 mb-10 text-white shadow-xl shadow-indigo-100 flex flex-col md:flex-row justify-between items-center gap-6">
    <div class="max-w-xl text-center md:text-left">
        <h3 class="text-xl font-bold mb-2">Dica de Atendimento 💡</h3>
        <p class="text-indigo-100 text-sm leading-relaxed">Priorize chamados do tipo **"Denúncia"** e certifique-se de dar retornos claros para que o manifestante sinta confiança no processo anônimo.</p>
    </div>
    <a href="{{ route('mgmt.chamados') }}" class="bg-white text-indigo-600 font-bold py-3 px-6 rounded-2xl hover:bg-indigo-50 transition-all shrink-0">
        Ver Todos os Chamados
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Ações Rápidas</h3>
        <div class="space-y-3">
            <a href="{{ route('mgmt.chamados') }}?status=Aberto" class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-colors">
                <span class="text-sm font-bold text-slate-700">Chamados em Aberto</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
            <p class="text-xs text-slate-400 px-2 mt-4 italic">* Mais funcionalidades serão adicionadas conforme a necessidade da gestão.</p>
        </div>
    </div>
</div>
@endsection
