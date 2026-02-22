<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Chamados Anônimos')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>SISTEMA DE CHAMADOS</h1>
        </div>

        @yield('content')

        <div class="footer">
            <p>&copy; {{ date('Y') }} Chamados Anônimos</p>
        </div>
    </div>
</body>

</html>
