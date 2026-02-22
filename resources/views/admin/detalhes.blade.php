@extends('layout')
@section('content')
    <!-- Detalhes do Chamado -->
    <h3>{{ $chamado->assunto }}</h3>
    <p>{{ $chamado->descricao }}</p>
    <p><strong>Tipo:</strong> {{ $chamado->tipo }}</p>
    <p><strong>Status:</strong> {{ ucfirst($chamado->status) }}</p>
    <p><strong>Data de Abertura:</strong> {{ $chamado->created_at->format('d/m/Y H:i') }}</p>

    {{-- <h4>Interações:</h4>
    <ul>
        @foreach ($chamado->interacoes as $interacao)
            <li><strong>{{ ucfirst($interacao->tipo) }}:</strong> {{ $interacao->mensagem }}</li>
        @endforeach
    </ul> --}}

    <h4>Interações</h4>
    <ul class="list-group mb-3">
        @foreach ($chamado->interacoes as $interacao)
            <li class="list-group-item">
                <strong>{{ ucfirst($interacao->tipo) }}:</strong><i>
                    {{ $interacao->mensagem }}</i> - <span style="font-size: smaller">{{ $interacao->updated_at }}</span>
            </li>
        @endforeach
    </ul>

    <!-- Formulário para adicionar resposta -->
    <form action="{{ route('admin.chamado.resposta', $chamado->login_hash) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea class="form-control" name="mensagem" id="mensagem" required></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" id="status">
                <option value="Aberto">Aberto</option>
                <option value="Fechado">Fechado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Resposta</button>
    </form>
    <a href="{{ route('admin.chamados') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection
