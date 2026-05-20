<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Comerciante - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Panel del comerciante</h1>
            <p class="text-sm text-gray-500">Administra tu comercio en LocalMarket 24hrs</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('marketplace.home') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Ver marketplace
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8">
        <h2 class="text-2xl font-bold text-slate-900">
            Bienvenido, {{ auth()->user()->name }}
        </h2>

        <p class="text-gray-500 mt-2">
            Este será tu panel para administrar productos, inventario y pedidos de tu comercio.
        </p>
    </section>

    @if (auth()->user()->commerce)
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Nombre del comercio</p>
                <h3 class="text-xl font-bold text-slate-900 mt-2">
                    {{ auth()->user()->commerce->name }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Estado</p>
                <h3 class="text-xl font-bold text-slate-900 mt-2">
                    {{ ucfirst(auth()->user()->commerce->status) }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categoría</p>
                <h3 class="text-xl font-bold text-slate-900 mt-2">
                    {{ auth()->user()->commerce->category->name ?? 'Sin categoría' }}
                </h3>
            </div>
        </section>
    @else
        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center">
            <h3 class="text-xl font-bold text-slate-900">
                Aún no tienes comercio registrado
            </h3>

            <p class="text-gray-500 mt-2">
                Crea tu comercio para empezar a vender productos.
            </p>

            <a href="{{ route('comerciante.commerce.create') }}"
               class="inline-block mt-5 px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                Crear comercio
            </a>
        </section>
    @endif

</main>

</body>
</html>
