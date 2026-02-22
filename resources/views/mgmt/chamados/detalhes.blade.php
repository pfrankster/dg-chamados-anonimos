@extends('layouts.mgmt')

@section('title', 'Gerenciar Chamado - Chamados Anônimos')

@section('mgmt-content')
<div class="mb-10 flex items-center gap-4">
    <a href="{{ route('mgmt.chamados') }}" class="p-2 rounded-full hover:bg-slate-100 transition-colors text-slate-400 hover:text-indigo-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Detalhes do Chamado</h2>
        <p class="text-slate-500 mt-1">Gerenciando protocolo <span class="font-mono font-bold text-indigo-600">{{ $chamado->login_hash }}</span></p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- Coluna da Esquerda: Informações e Histórico -->
    <div class="lg:col-span-2 space-y-10">
        <!-- Info do Chamado -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8">
            <div class="flex flex-wrap gap-4 mb-6">
                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-wider">{{ $chamado->tipo }}</span>
                <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-full text-xs font-bold uppercase tracking-wider">Criado em {{ $chamado->created_at->format('d/m/Y H:i') }}</span>
            </div>
            
            <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ $chamado->assunto }}</h3>
            <div class="bg-slate-50 rounded-2xl p-6 text-slate-700 leading-relaxed italic border border-slate-100">
                "{{ $chamado->descricao }}"
            </div>
        </div>

        <!-- Histórico Compacto -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Histórico de Interações
                </h3>
                <span class="text-xs font-medium text-slate-400">{{ $chamado->interacoes->count() }} mensagens</span>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($chamado->interacoes as $interacao)
                    <div class="p-6 hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-tighter {{ $interacao->tipo === 'resposta' ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $interacao->tipo === 'resposta' ? 'Atendente' : 'Manifestante' }}
                                </span>
                                @if($interacao->user_id)
                                    <span class="text-[10px] text-slate-400 font-medium italic">— Resposta por #{{ $interacao->user_id }}</span>
                                @endif
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $interacao->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <p class="text-sm text-slate-700 leading-relaxed font-outfit">{{ $interacao->mensagem }}</p>
                    </div>
                @empty
                    <div class="p-10 text-center text-slate-400 italic text-sm">Nenhuma interação registrada.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Coluna da Direita: Painel de Resposta -->
    <div class="space-y-8">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl p-8 sticky top-8">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Enviar Resposta</h3>
            
            <form action="{{ route('mgmt.chamado.resposta', $chamado->login_hash) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Mensagem</label>
                    <textarea name="mensagem" rows="6" required placeholder="Escreva sua resposta aqui..."
                        class="block w-full rounded-xl border-slate-200 bg-slate-50 py-3 px-4 text-slate-900 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500 transition-all resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Novo Status</label>
                    <select name="status" class="block w-full rounded-xl border-slate-200 bg-slate-50 py-3 px-4 text-slate-900 focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                        <option value="Aberto" {{ $chamado->status === 'Aberto' ? 'selected' : '' }}>Aberto</option>
                        <option value="Em Análise" {{ $chamado->status === 'Em Análise' ? 'selected' : '' }}>Em Análise</option>
                        <option value="Fechado" {{ $chamado->status === 'Fechado' ? 'selected' : '' }}>Fechado</option>
                        <option value="Concluído" {{ $chamado->status === 'Concluído' ? 'selected' : '' }}>Concluído</option>
                    </select>
                </div>

                <button type="submit" 
                    class="w-full flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 shadow-lg shadow-indigo-100 hover:-translate-y-1">
                    <span>Enviar Resposta</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
