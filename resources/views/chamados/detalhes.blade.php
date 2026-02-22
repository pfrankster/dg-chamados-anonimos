@extends('layout')
@section('content')
    <h3>Detalhes do Chamado</h3>

    <div class="mb-3">
        {{-- <label class="form-label">Assunto:</label> --}}
        <p>Assunto: {{ $chamado->assunto }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">Mensagem inicial:</label>
        <p><i>{{ $chamado->descricao }}</i></p>
    </div>

    <div class="mb-3">
        {{-- <label class="form-label">Status:</label> --}}
        <p>Status: {{ ucfirst($chamado->status) }}</p>
    </div>

    <h4>Interações</h4>
    <ul class="list-group mb-3">
        @foreach ($chamado->interacoes as $interacao)
            <li class="list-group-item">
                <strong>{{ ucfirst($interacao->tipo) }}:</strong><i>
                    {{ $interacao->mensagem }}</i> - <span style="font-size: smaller">{{ $interacao->updated_at }}</span>
            </li>
        @endforeach
    </ul>

    @if ($chamado->status === 'Aberto')
        <form action="{{ route('chamado.interagir', ['hash' => $chamado->login_hash]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="mensagem" class="form-label">Adicionar nova interação</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Interação</button>
        </form>
    @else
        <p>O chamado está fechado. Não é possível adicionar interações.</p>
    @endif
    <a href="{{ route('chamado.consulta') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection
