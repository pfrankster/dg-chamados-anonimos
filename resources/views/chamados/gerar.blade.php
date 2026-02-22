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
                <form action="{{ route('chamado.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
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

                    <!-- Anexos -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Anexos (Opcional)</label>
                        <div class="relative group">
                            <div class="flex items-center justify-center w-full">
                                <label for="anexos" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-200 border-dashed rounded-2xl cursor-pointer bg-slate-50/50 group-hover:bg-slate-100 group-hover:border-indigo-400 transition-all">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-slate-500 group-hover:text-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="text-sm font-medium">Clique para enviar ou arraste os arquivos</p>
                                        <p class="text-xs opacity-60">PNG, JPG, PDF, DOC (Max. 5 arquivos, 5MB cada)</p>
                                    </div>
                                    <input id="anexos" name="anexos[]" type="file" class="hidden" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" />
                                </label>
                            </div>
                            <div id="file-list" class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2"></div>
                        </div>
                        @error('anexos')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('anexos.*')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <script>
                        document.getElementById('anexos').addEventListener('change', function(e) {
                            const list = document.getElementById('file-list');
                            list.innerHTML = '';
                            
                            const files = Array.from(e.target.files).slice(0, 5);
                            if (e.target.files.length > 5) {
                                alert('Você só pode selecionar até 5 arquivos.');
                                // Opcional: resetar input ou truncar
                            }

                            files.forEach(file => {
                                const item = document.createElement('div');
                                item.className = 'flex items-center gap-2 p-2 bg-indigo-50 border border-indigo-100 rounded-lg text-xs font-medium text-indigo-700';
                                item.innerHTML = `
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                    <span class="truncate">${file.name}</span>
                                    <span class="ml-auto opacity-50">${(file.size / 1024).toFixed(1)} KB</span>
                                `;
                                list.appendChild(item);
                            });
                        });
                    </script>

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
