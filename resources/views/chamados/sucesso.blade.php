<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chamado Criado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5 text-center">
    <h2>Chamado Criado com Sucesso!</h2>
    <h5 style="color: red">Atenção! Antes de fechar esta janela anote estas credenciais, elas serão a única maneira de
        acompanhar este chamado.</h5>
    <div class="alert alert-success">
        <p><strong>Login:</strong> {{ $login }}</p>
        <p><strong>Senha:</strong> {{ $senha }}</p>
    </div>

    {{-- <p>Anote essas credenciais para acompanhar o status do seu chamado.</p> --}}

    <a href="{{ route('chamado.create') }}" class="btn btn-primary">Abrir Novo Chamado</a>
    <a href="{{ route('chamado.consulta') }}" class="btn btn-secondary">Consultar Chamado</a>
</body>

</html>
