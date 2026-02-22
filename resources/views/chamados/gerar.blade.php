<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abrir Chamado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h2>Abrir Novo Chamado</h2>

    <form action="{{ route('chamado.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="instituicao" class="form-label">Instituição</label>
            <select class="form-select" name="instituicao" id="instituicao" required>
                <option value="">Selecione...</option>
                <option value="provincia">Província</option>
                <option value="projari">PROJARI</option>
                <option value="caritativo">Caritativo</option>
                <option value="hospital">Hospital</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="assunto" class="form-label">Assunto</label>
            <input type="text" class="form-control" id="assunto" name="assunto" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
        </div>



        <button type="submit" class="btn btn-primary">Enviar Chamado</button>
    </form>
</body>

</html>
