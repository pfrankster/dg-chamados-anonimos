@extends('layouts.mgmt')

@section('title', 'Todos os Chamados - Chamados Anônimos')

@section('mgmt-content')
<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Gestão de Chamados</h2>
    <p class="text-slate-500 mt-2">Acompanhe e responda às manifestações recebidas.</p>
</div>

<!-- Barra de Filtros -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 mb-6">
    <form method="GET" action="{{ route('mgmt.chamados') }}" class="flex flex-col lg:flex-row items-stretch lg:items-end gap-4">
        
        <!-- Pesquisa -->
        <div class="flex-1">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Pesquisar</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Protocolo, assunto ou descrição..." 
                    class="block w-full rounded-xl border-slate-200 bg-slate-50 py-2.5 pl-10 pr-4 text-sm text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
            </div>
        </div>

        <!-- Filtro Status -->
        <div class="w-full lg:w-44">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Status</label>
            <select name="status" class="block w-full rounded-xl border-slate-200 bg-slate-50 py-2.5 px-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                <option value="">Todos</option>
                <option value="Aberto" {{ request('status') === 'Aberto' ? 'selected' : '' }}>Aberto</option>
                <option value="Em Análise" {{ request('status') === 'Em Análise' ? 'selected' : '' }}>Em Análise</option>
                <option value="Concluído" {{ request('status') === 'Concluído' ? 'selected' : '' }}>Concluído</option>
                <option value="Fechado" {{ request('status') === 'Fechado' ? 'selected' : '' }}>Fechado</option>
            </select>
        </div>

        <!-- Filtro Tipo -->
        <div class="w-full lg:w-48">
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Tipo</label>
            <select name="tipo" class="block w-full rounded-xl border-slate-200 bg-slate-50 py-2.5 px-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                <option value="">Todos</option>
                <option value="Denúncia" {{ request('tipo') === 'Denúncia' ? 'selected' : '' }}>Denúncia</option>
                <option value="Questionamento (LGPD)" {{ request('tipo') === 'Questionamento (LGPD)' ? 'selected' : '' }}>Questionamento (LGPD)</option>
                <option value="Solicitação" {{ request('tipo') === 'Solicitação' ? 'selected' : '' }}>Solicitação</option>
                <option value="Sugestão" {{ request('tipo') === 'Sugestão' ? 'selected' : '' }}>Sugestão</option>
                <option value="Elogio" {{ request('tipo') === 'Elogio' ? 'selected' : '' }}>Elogio</option>
                <option value="Outros" {{ request('tipo') === 'Outros' ? 'selected' : '' }}>Outros</option>
            </select>
        </div>

        <!-- Atenção -->
        <div class="flex items-end gap-2">
            <label class="flex items-center gap-2 px-4 py-2.5 rounded-xl border cursor-pointer transition-all text-sm font-bold
                {{ request('atencao') == '1' ? 'border-amber-300 bg-amber-50 text-amber-700' : 'border-slate-200 bg-slate-50 text-slate-500 hover:border-amber-300' }}">
                <input type="checkbox" name="atencao" value="1" {{ request('atencao') == '1' ? 'checked' : '' }} class="hidden" onchange="this.form.submit()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Aguardando
            </label>
        </div>

        <!-- Botões -->
        <div class="flex items-end gap-2">
            <button type="submit" class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm text-white transition-all hover:-translate-y-0.5" style="background-color: #4f46e5;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filtrar
            </button>
            @if(request()->hasAny(['busca', 'status', 'tipo', 'atencao']))
                <a href="{{ route('mgmt.chamados') }}" class="flex items-center gap-1 px-4 py-2.5 rounded-xl font-bold text-sm text-slate-500 bg-slate-100 hover:bg-slate-200 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Limpar
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Contagem de Resultados -->
<div class="flex items-center justify-between mb-4 px-1">
    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">
        {{ $chamados->total() }} {{ $chamados->total() === 1 ? 'chamado encontrado' : 'chamados encontrados' }}
    </p>
    @if(request()->hasAny(['busca', 'status', 'tipo', 'atencao']))
        <div class="flex flex-wrap gap-1.5">
            @if(request('busca'))
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                    Busca: "{{ request('busca') }}"
                </span>
            @endif
            @if(request('status'))
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-50 text-green-600 border border-green-100">
                    {{ request('status') }}
                </span>
            @endif
            @if(request('tipo'))
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                    {{ request('tipo') }}
                </span>
            @endif
            @if(request('atencao') == '1')
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-100">
                    Aguardando Resposta
                </span>
            @endif
        </div>
    @endif
</div>

<!-- Tabela -->
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Protocolo</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Assunto</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Data</th>
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
                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-400 font-medium">
                        {{ $chamado->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-1.5">
                                @if($chamado->status === 'Aberto')
                                    <span class="h-2 w-2 rounded-full {{ $chamado->precisaAtencao() ? 'animate-pulse' : '' }}" style="background-color: #22c55e;"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider" style="color: #16a34a;">Aberto</span>
                                @elseif($chamado->status === 'Em Análise')
                                    <span class="h-2 w-2 rounded-full {{ $chamado->precisaAtencao() ? 'animate-pulse' : '' }}" style="background-color: #6366f1;"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider" style="color: #4f46e5;">Em Análise</span>
                                @elseif($chamado->status === 'Concluído' || $chamado->status === 'Fechado')
                                    <span class="h-2 w-2 rounded-full" style="background-color: #cbd5e1;"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider" style="color: #94a3b8;">{{ $chamado->status }}</span>
                                @else
                                    <span class="h-2 w-2 rounded-full" style="background-color: #94a3b8;"></span>
                                    <span class="text-xs font-bold uppercase tracking-wider" style="color: #64748b;">{{ $chamado->status }}</span>
                                @endif
                            </div>
                            
                            @if($chamado->precisaAtencao())
                                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-black w-fit uppercase tracking-tighter shadow-sm" style="background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a;">
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
                            class="inline-flex items-center gap-2 font-bold text-sm transition-colors" style="color: #4f46e5;">
                            <span>Gerenciar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic text-sm">
                        @if(request()->hasAny(['busca', 'status', 'tipo', 'atencao']))
                            Nenhum chamado encontrado com os filtros aplicados.
                        @else
                            Nenhum chamado registrado ainda.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginação -->
@if($chamados->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $chamados->links() }}
    </div>
@endif
@endsection
