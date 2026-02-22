@extends('layout')

@section('title', 'Detalhes do Chamado - Chamados Anônimos')

@section('content')
<div style="max-width: 56rem; margin-left: auto; margin-right: auto; padding: 3rem 1rem;">
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Detalhes do Chamado</h2>
            <p class="text-slate-500 mt-2">Acompanhe o andamento da sua manifestação protocolo <span class="font-mono font-bold text-indigo-600">{{ $chamado->login_hash }}</span></p>
        </div>
        <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl font-bold text-sm transition-all hover:-translate-y-0.5" style="background-color: #F7c863; color: #64748b; border: 1px solid #e2e8f0;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Sair
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
                <div class="text-slate-600 leading-relaxed bg-slate-50 rounded-2xl p-6 italic border border-slate-100 relative quote-icon mb-4">
                    "{{ $chamado->descricao }}"
                </div>

                @if($chamado->anexos->count() > 0)
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach($chamado->anexos as $anexo)
                            <a href="{{ Storage::url($anexo->file_path) }}" target="_blank" 
                                class="flex items-center gap-2 px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-600 hover:border-indigo-400 hover:text-indigo-600 transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="max-w-[150px] truncate">{{ $anexo->original_name }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
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
                        
                        @if($interacao->anexos->count() > 0)
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach($interacao->anexos as $anexo)
                                    <a href="{{ Storage::url($anexo->file_path) }}" target="_blank" 
                                        class="flex items-center gap-2 px-3 py-2 bg-slate-50 border border-slate-100 rounded-xl text-[10px] font-bold text-slate-500 hover:border-indigo-300 hover:text-indigo-600 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                        <span class="max-w-[120px] truncate">{{ $anexo->original_name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
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
            <div class="rounded-3xl p-8 shadow-xl animate-in zoom-in-95 duration-500" style="background-color: #312e81; color: #fff;">
                <h3 class="text-xl font-bold mb-2">Deseja acrescentar algo?</h3>
                <p class="text-sm mb-6" style="color: #a5b4fc;">Sua mensagem será enviada diretamente à nossa equipe técnica. Você também pode anexar arquivos se necessário.</p>

                <form action="{{ route('chamado.interagir', ['hash' => $chamado->login_hash]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <textarea name="mensagem" rows="4" required placeholder="Digite sua mensagem aqui..."
                        class="block w-full rounded-2xl border-0 py-4 px-5 transition-all resize-none" style="background-color: rgba(255,255,255,0.1); color: #fff;"></textarea>
                    
                    <div class="flex flex-wrap items-center gap-4">
                        <label for="anexos_interacao" class="flex items-center gap-2 px-4 py-2 rounded-xl cursor-pointer transition-all text-xs font-bold" style="background-color: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            Anexar Arquivos (Até 5)
                            <input id="anexos_interacao" name="anexos[]" type="file" class="hidden" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" />
                        </label>
                        <div id="file-list" class="flex flex-wrap gap-2"></div>
                    </div>

                    <script>
                        document.getElementById('anexos_interacao').addEventListener('change', function(e) {
                            const list = document.getElementById('file-list');
                            list.innerHTML = '';
                            const files = Array.from(e.target.files).slice(0, 5);
                            files.forEach(file => {
                                const item = document.createElement('span');
                                item.className = 'px-2 py-1 rounded text-xs font-medium';
                                item.style.cssText = 'background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.05);color:#fff;';
                                item.textContent = file.name;
                                list.appendChild(item);
                            });
                        });
                    </script>
                    
                    <button type="submit" class="inline-flex items-center gap-2 font-bold py-4 px-8 rounded-2xl transition-all duration-300 shadow-lg hover:-translate-y-1 mt-4" style="background-color: #fff; color: #312e81;">
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
