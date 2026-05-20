<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">LocalMarket 24hrs</h1>
            <p class="text-sm text-gray-500">Marketplace local para comercios cercanos</p>
        </div>

        <nav class="flex items-center gap-3">
            @auth
                @if (auth()->user()->role === 'comerciante')
                    <a href="{{ route('comerciante.dashboard') }}"
                       class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                        Mi comercio
                    </a>
                @else
                    <a href="{{ route('comerciante.commerce.create') }}"
                       class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                        Vender en LocalMarket
                    </a>
                @endif

                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Mi cuenta
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-lg text-slate-700 hover:bg-gray-100">
                    Iniciar sesión
                </a>

                <a href="{{ route('register') }}"
                   class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                    Registrarse
                </a>
            @endauth
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8">
        <div class="max-w-3xl">
            <h2 class="text-3xl font-bold text-slate-900">
                Compra en comercios locales desde una sola plataforma
            </h2>

            <p class="text-gray-500 mt-3">
                Explora negocios cercanos, encuentra productos y apoya a pequeños comercios locales.
            </p>
        </div>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
        <form method="GET" action="{{ route('marketplace.home') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                    Buscar comercio
                </label>

                <input type="text"
                       id="search"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Ejemplo: comida, ropa, tecnología..."
                       class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Categoría
                </label>

                <select id="category_id"
                        name="category_id"
                        class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                    <option value="">Todas</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                    Filtrar
                </button>

                <a href="{{ route('marketplace.home') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Limpiar
                </a>
            </div>
        </form>
    </section>

    <section>
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-2xl font-bold text-slate-900">Comercios disponibles</h3>
                <p class="text-gray-500 text-sm">Explora los negocios activos en la plataforma.</p>
            </div>
        </div>

        @if ($commerces->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($commerces as $commerce)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="h-32 bg-slate-200 flex items-center justify-center">
                            @if ($commerce->banner)
                                <img src="{{ asset('storage/' . $commerce->banner) }}"
                                     alt="{{ $commerce->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-500 text-sm">Sin banner</span>
                            @endif
                        </div>

                        <div class="p-5">
                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($commerce->name, 0, 1)) }}
                                </div>

                                <div>
                                    <h4 class="font-bold text-lg text-slate-900">
                                        {{ $commerce->name }}
                                    </h4>

                                    <p class="text-sm text-gray-500">
                                        {{ $commerce->category->name ?? 'Sin categoría' }}
                                    </p>
                                </div>
                            </div>

                            <p class="text-gray-500 text-sm mt-4">
                                {{ $commerce->description ?? 'Este comercio aún no tiene descripción.' }}
                            </p>

                            <div class="mt-5">
                                <a href="#"
                                   class="block text-center px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                                    Ver comercio
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $commerces->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center">
                <h4 class="text-xl font-bold text-slate-900">
                    Todavía no hay comercios disponibles
                </h4>

                <p class="text-gray-500 mt-2">
                    Cuando los usuarios creen sus comercios, aparecerán aquí.
                </p>
            </div>
        @endif
    </section>

</main>

</body>
</html>
