<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Central Mayor C.A.')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --sidebar-width: 260px; }
        [data-theme="dark"] { background-color: #0f172a; color: #e2e8f0; }
        [data-theme="dark"] .bg-light { background-color: #1e293b !important; }
        [data-theme="dark"] .card { background-color: #1e293b; border-color: #334155; color: #e2e8f0; }
        [data-theme="dark"] .text-dark { color: #e2e8f0 !important; }
        [data-theme="dark"] .table { --bs-table-bg: #1e293b; --bs-table-color: #e2e8f0; }
        [data-theme="dark"] .btn-outline-secondary { color: #e2e8f0; border-color: #475569; }
        .sidebar a.active { background-color: white; color: #3b82f6 !important; }
        .sidebar a:hover { background-color: rgba(255,255,255,0.1); }
    </style>
</head>
<body class="font-sans bg-light min-vh-100">

    <!-- SIDEBAR -->
    <div class="sidebar bg-primary text-white position-fixed top-0 start-0 h-100 shadow-lg" style="width: var(--sidebar-width); z-index: 1000;">
        <div class="p-4 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60" class="mb-3 rounded-circle">
            <h1 class="h5 fw-bold">Central Mayor</h1>
        </div>
                <nav class="px-3">
            <a href="{{ route('inventario') }}" class="d-flex align-items-center text-white p-3 rounded mb-2 {{ request()->routeIs('inventario') ? 'active' : '' }}">
                <i data-lucide="package" class="me-3"></i> Inventario
            </a>
            <a href="{{ route('ventas') }}" class="d-flex align-items-center text-white p-3 rounded mb-2 {{ request()->routeIs('ventas') ? 'active' : '' }}">
                <i data-lucide="dollar-sign" class="me-3"></i> Ventas
            </a>
            <a href="{{ route('finanzas') }}" class="d-flex align-items-center text-white p-3 rounded mb-2 {{ request()->routeIs('finanzas') ? 'active' : '' }}">
                <i data-lucide="file-text" class="me-3"></i> Finanzas
            </a>
            <a href="{{ route('resumen') }}" class="d-flex align-items-center text-white p-3 rounded mb-2 {{ request()->routeIs('resumen') ? 'active' : '' }}">
                <i data-lucide="bar-chart-3" class="me-3"></i> Resumen
            </a>
        </nav>
        <div class="position-absolute bottom-0 start-0 p-3 w-100">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content" style="margin-left: var(--sidebar-width); min-height: 100vh;">
               <header class="bg-white shadow-sm p-3 d-flex justify-content-between align-items-center">
            <!-- BOTÓN LOGOUT A LA IZQUIERDA -->
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i data-lucide="log-out" class="me-1"></i> Salir
                </button>
            </form>

            <!-- BOTÓN MODO OSCURO A LA DERECHA -->
            <button id="theme-toggle" class="btn btn-outline-secondary">
                <i data-lucide="sun"></i>
            </button>
        </header>

        <main class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script>
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        const sun = '<i data-lucide="sun"></i>';
        const moon = '<i data-lucide="moon"></i>';

        toggle.addEventListener('click', () => {
            if (html.getAttribute('data-theme') === 'dark') {
                html.setAttribute('data-theme', 'light');
                toggle.innerHTML = moon;
                localStorage.setItem('theme', 'light');
            } else {
                html.setAttribute('data-theme', 'dark');
                toggle.innerHTML = sun;
                localStorage.setItem('theme', 'dark');
            }
            createIcons();
        });

        if (localStorage.getItem('theme') === 'dark') {
            html.setAttribute('data-theme', 'dark');
            toggle.innerHTML = sun;
        } else {
            toggle.innerHTML = moon;
        }
        createIcons();
    </script>
</body>
</html>