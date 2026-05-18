<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="min-h-screen flex">

    <aside class="w-64 bg-slate-900 text-white hidden md:flex md:flex-col">
        <div class="px-6 py-5 border-b border-slate-700">
            <h1 class="text-xl font-bold">LocalMarket</h1>
            <p class="text-sm text-slate-300">Panel administrador</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="block px-4 py-2 rounded-lg font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                Categorías
            </a>

            <a href="#"
               class="block px-4 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
                Usuarios
            </a>

            <a href="#"
               class="block px-4 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
                Comercios
            </a>

            <a href="#"
               class="block px-4 py-2 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white">
                Reportes
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-slate-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left px-4 py-2 rounded-lg text-red-300 hover:bg-red-500 hover:text-white">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col">

        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        @yield('title', 'Panel Administrativo')
                    </h2>
                    <p class="text-sm text-gray-500">
                        Administración general de LocalMarket 24hrs
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-700">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Administrador
                        </p>
                    </div>

                    <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-6">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
