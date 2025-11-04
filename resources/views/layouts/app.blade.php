<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Central Mayor C.A.')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="h-full font-sans antialiased bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white min-h-screen p-4 flex flex-col">
            <div class="flex items-center mb-8">
                <div class="h-10 w-10 bg-white rounded-lg flex items-center justify-center mr-3">
                    <i data-lucide="package" class="h-6 w-6 text-blue-700"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold">Central Mayor</h1>
                    <p class="text-xs opacity-75">Sistema de Gestión</p>
                </div>
            </div>

            <nav class="space-y-1 flex-1">
                @php
                    $navItems = [
                        ['route' => 'inventario', 'icon' => 'package', 'label' => 'Inventario'],
                        ['route' => 'ventas', 'icon' => 'dollar-sign', 'label' => 'Ventas'],
                        ['route' => 'finanzas', 'icon' => 'file-text', 'label' => 'Finanzas'],
                        ['route' => 'resumen', 'icon' => 'bar-chart-3', 'label' => 'Resumen'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 
                              {{ request()->routeIs($item['route']) ? 'bg-white text-blue-700 shadow-md' : 'hover:bg-blue-800' }}">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
                        <span class="font-medium">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto pt-8 border-t border-blue-800">
                <div class="flex items-center space-x-3 px-4">
                    <div class="h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i data-lucide="user" class="h-5 w-5 text-white"></i>
                    </div>
                    <div>
                        <p class="font-medium text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-xs opacity-75">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Contenido Principal -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-3 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <h2 class="text-xl font-semibold text-gray-800">
                            @yield('title', 'Dashboard')
                        </h2>
                    </div>

                    <div class="flex items-center space-x-3">
                        <button id="theme-toggle" class="p-2 rounded-lg hover:bg-gray-100 transition">
                            <i data-lucide="sun" class="w-5 h-5 text-gray-700"></i>
                        </button>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="flex items-center space-x-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                <span>Salir</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Contenido -->
            <main class="flex-1 p-6 bg-gray-50 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            // Modo oscuro (opcional)
            const toggle = document.getElementById('theme-toggle');
            if (toggle) {
                toggle.addEventListener('click', () => {
                    document.documentElement.classList.toggle('dark');
                    const icon = toggle.querySelector('i');
                    icon.setAttribute('data-lucide', document.documentElement.classList.contains('dark') ? 'moon' : 'sun');
                    lucide.createIcons();
                });
            }
        });
    </script>
</body>
</html>