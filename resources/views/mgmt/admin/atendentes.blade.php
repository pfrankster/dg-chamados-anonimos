@extends('layouts.mgmt')

@section('title', 'Gestão de Atendentes - Chamados Anônimos')

@section('mgmt-content')
<div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Gestão de Atendentes</h2>
        <p class="text-slate-500 mt-2">Cadastre e gerencie a equipe de resposta.</p>
    </div>
    
    <button onclick="document.getElementById('modal-atendente').classList.remove('hidden')" 
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-2xl transition-all shadow-lg shadow-indigo-100 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Novo Atendente
    </button>
</div>

<!-- Tabela de Atendentes -->
<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Nome</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">E-mail</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Criado em</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($attendants as $attendant)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">
                                {{ substr($attendant->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-bold text-slate-900">{{ $attendant->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $attendant->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $attendant->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <form action="{{ route('mgmt.admin.atendentes.destroy', $attendant->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este atendente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v2m3 3h8.5" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic text-sm">Nenhum atendente cadastrado no momento.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Novo Atendente (Simplificado) -->
<div id="modal-atendente" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl overflow-hidden">
        <form action="{{ route('mgmt.admin.atendentes.store') }}" method="POST">
            @csrf
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-900 font-outfit">Novo Atendente</h3>
                    <button type="button" onclick="document.getElementById('modal-atendente').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" />
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nome Completo</label>
                        <input type="text" name="name" required class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">E-mail</label>
                        <input type="email" name="email" required class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Senha</label>
                            <input type="password" name="password" required class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" required class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-8 py-6 flex flex-col sm:flex-row gap-3">
                <button type="button" onclick="document.getElementById('modal-atendente').classList.add('hidden')" 
                    class="order-2 sm:order-1 flex-1 py-3 px-4 text-sm font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">Cancelar</button>
                <button type="submit" 
                    class="order-1 sm:order-2 flex-1 py-3 px-4 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Criar Atendente</button>
            </div>
        </form>
    </div>
</div>
@endsection
