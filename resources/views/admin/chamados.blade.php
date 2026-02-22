<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Chamados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h2>Lista de Chamados</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Login (Hash)</th>
                <th>Status</th>
                <th>Data de Abertura</th>
                <th>Alerta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chamados as $chamado)
                @php
                    $temNovaInteracao = $chamado->interacoes->last()?->tipo === 'solicitante';
                @endphp

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $chamado->login_hash }}</td>
                    <td>{{ ucfirst($chamado->status) }}</td>
                    <td>{{ $chamado->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if ($temNovaInteracao)
                            <span title="Nova interação do usuário">⚠️</span>
                        @endif

                    </td>
                    <td>
                        <a href="{{ route('admin.chamado.detalhes', $chamado->login_hash) }}"
                            class="btn btn-info btn-sm">Ver Detalhes</a>
                        <a href="{{ route('admin.chamado.resposta', $chamado->login_hash) }}"
                            class="btn btn-primary btn-sm">Adicionar Resposta</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
