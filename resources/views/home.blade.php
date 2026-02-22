<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Chamados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h2>Bem-vindo ao Sistema de Chamados Anônimos</h2>
    <p>Nosso sistema foi criado para permitir que qualquer pessoa registre um chamado de forma 100% anônima. Seja para
        relatar uma denúncia, fazer um questionamento sobre direitos e regulamentos (como a LGPD) ou qualquer outra
        solicitação que não requeira sua identificação, aqui você pode expressar suas preocupações com total
        privacidade.</p>

    <p>Nenhuma informação pessoal é coletada. Ao registrar um chamado, você receberá um login e senha gerados
        automaticamente para acompanhar o andamento e interagir com as respostas do administrador.</p>
    <p>Escolha uma das opções abaixo para continuar:</p>
    <div class="d-flex flex-column align-items-center gap-3 mt-4">
        <a href="{{ route('chamado.create') }}" class="btn btn-primary btn-lg w-50 py-3">Abrir Novo Chamado</a>
        <a href="{{ route('chamado.consulta') }}" class="btn btn-secondary btn-lg w-50 py-3">Consultar Chamado</a>
    </div>

</body>

</html>
