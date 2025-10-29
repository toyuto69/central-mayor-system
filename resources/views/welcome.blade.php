<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Central Mayor C.A.</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body text-center p-5">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="80" class="mb-4">
                        <h1 class="h3 fw-bold text-primary">Bienvenido a Central Mayor C.A.</h1>
                        <p class="text-muted">Por favor, inicia sesión para acceder al sistema.</p>
                        <div class="d-grid gap-2 mt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Iniciar Sesión</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary">Registrarse</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>