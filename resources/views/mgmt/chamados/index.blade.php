@extends('layouts.mgmt')

@section('title', 'Todos os Chamados - Chamados Anônimos')

@section('mgmt-content')
<div class="mb-10">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Gestão de Chamados</h2>
    <p class="text-slate-500 mt-2">Acompanhe e responda às manifestações recebidas.</p>
</div>

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Protocolo</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Assunto</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($chamados as $chamado)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-mono font-bold text-slate-900">{{ $chamado->login_hash }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold">
                            {{ $chamado->tipo }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 truncate max-w-xs">{{ $chamado->assunto }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-1.5">
                                @if($chamado->status === 'Aberto')
                                    <span class="h-2 w-2 rounded-full bg-green-500 {{ $chamado->precisaAtencao() ? 'animate-pulse' : '' }}"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-green-600">Aberto</span>
                                @elseif($chamado->status === 'Em Análise')
                                    <span class="h-2 w-2 rounded-full bg-indigo-500 {{ $chamado->precisaAtencao() ? 'animate-pulse' : '' }}"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600">Em Análise</span>
                                @elseif($chamado->status === 'Concluído' || $chamado->status === 'Fechado')
                                    <span class="h-2 w-2 rounded-full bg-slate-300"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $chamado->status }}</span>
                                @else
                                    <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">{{ $chamado->status }}</span>
                                @endif
                            </div>
                            
                            @if($chamado->precisaAtencao())
                                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-black bg-amber-100 text-amber-700 w-fit uppercase tracking-tighter shadow-sm border border-amber-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Aguardando Resposta
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <a href="{{ route('mgmt.chamado.detalhes', $chamado->login_hash) }}" 
                            class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-bold text-sm transition-colors">
                            <span>Gerenciar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">Nenhum chamado encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
