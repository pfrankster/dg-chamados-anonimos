@extends('layout')

@section('title', 'Detalhes do Chamado - Chamados Anônimos')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Detalhes do Chamado</h2>
            <p class="text-slate-500 mt-2">Acompanhe o andamento da sua manifestação protocolo <span class="font-mono font-bold text-indigo-600">{{ $chamado->login_hash }}</span></p>
        </div>
        <a href="{{ route('chamado.consulta') }}" class="flex items-center gap-2 text-slate-400 hover:text-indigo-600 font-bold text-sm transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Voltar
        </a>
    </div>

    <div class="space-y-8">
        <!-- Card Principal de Informações -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-500">
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
                <div class="flex gap-3">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-wider">{{ $chamado->tipo }}</span>
                    <span class="px-3 py-1 bg-white border border-slate-200 text-slate-500 rounded-full text-xs font-bold uppercase tracking-wider">Criado em {{ $chamado->created_at->format('d/m/Y H:i') }}</span>
                </div>
                
                <div class="flex items-center gap-2">
                    @if($chamado->status === 'Aberto')
                        <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-xs font-black uppercase tracking-widest text-green-600">Aberto</span>
                    @elseif($chamado->status === 'Em Análise')
                        <span class="h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
                        <span class="text-xs font-black uppercase tracking-widest text-indigo-600">Em Análise</span>
                    @else
                        <span class="h-2 w-2 rounded-full bg-slate-300"></span>
                        <span class="text-xs font-black uppercase tracking-widest text-slate-400">{{ $chamado->status }}</span>
                    @endif
                </div>
            </div>

            <div class="p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-4">{{ $chamado->assunto }}</h3>
                <div class="text-slate-600 leading-relaxed bg-slate-50 rounded-2xl p-6 italic border border-slate-100 relative quote-icon">
                    "{{ $chamado->descricao }}"
                </div>
            </div>
        </div>

        <!-- Histórico de Interações -->
        <div class="space-y-6">
            <h3 class="text-2xl font-bold text-slate-900 flex items-center gap-3 px-2">
                <div class="h-8 w-1 bg-indigo-600 rounded-full"></div>
                Histórico de Interações
            </h3>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                @forelse($chamado->interacoes as $interacao)
                    <div class="p-6 {{ !$loop->last ? 'border-b border-slate-100' : '' }} hover:bg-slate-50/50 transition-colors">
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $interacao->tipo === 'solicitante' ? 'bg-slate-100 text-slate-600' : 'bg-indigo-100 text-indigo-700' }}">
                                {{ $interacao->tipo === 'solicitante' ? 'Você' : 'Atendente' }}
                            </span>
                            <span class="text-[10px] font-medium text-slate-400">{{ $interacao->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <p class="text-slate-700 leading-relaxed">{{ $interacao->mensagem }}</p>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="bg-slate-50 h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <p class="text-slate-400 italic">Ainda não há interações neste chamado.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Formulário de Interação -->
        @if ($chamado->status === 'Aberto' || $chamado->status === 'Em Análise')
            <div class="bg-indigo-900 rounded-3xl p-8 text-white shadow-xl shadow-indigo-200 animate-in zoom-in-95 duration-500">
                <h3 class="text-xl font-bold mb-2">Deseja acrescentar algo?</h3>
                <p class="text-indigo-200 text-sm mb-6">Sua mensagem será enviada diretamente à nossa equipe técnica.</p>

                <form action="{{ route('chamado.interagir', ['hash' => $chamado->login_hash]) }}" method="POST" class="space-y-4">
                    @csrf
                    <textarea name="mensagem" rows="4" required placeholder="Digite sua mensagem aqui..."
                        class="block w-full rounded-2xl border-0 bg-white/10 py-4 px-5 text-white placeholder:text-indigo-300 focus:ring-2 focus:ring-inset focus:ring-indigo-400 transition-all resize-none"></textarea>
                    
                    <button type="submit" class="inline-flex items-center gap-2 bg-white text-indigo-900 font-bold py-4 px-8 rounded-2xl hover:bg-indigo-50 transition-all duration-300 shadow-lg shadow-black/10 hover:-translate-y-1">
                        <span>Enviar Mensagem</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </button>
                </form>
            </div>
        @else
            <div class="bg-slate-100 rounded-3xl p-8 text-center border border-slate-200">
                <p class="text-slate-500 font-medium italic">Este chamado foi encerrado e não aceita mais novas interações.</p>
            </div>
        @endif
    </div>
</div>
@endsection
