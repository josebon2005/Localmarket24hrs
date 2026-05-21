<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $commerce->name }} - LocalMarket 24hrs</title>

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
            <a href="{{ route('marketplace.home') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Volver
            </a>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                    Mi cuenta
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                    Iniciar sesión
                </a>
            @endauth
        </nav>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="h-48 bg-slate-200 flex items-center justify-center">
            @if ($commerce->banner)
                <img src="{{ asset('storage/' . $commerce->banner) }}"
                     alt="{{ $commerce->name }}"
                     class="w-full h-full object-cover">
            @else
                <span class="text-gray-500">Comercio sin banner</span>
            @endif
        </div>

        <div class="p-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">
                        {{ $commerce->name }}
                    </h2>

                    <p class="text-gray-500 mt-1">
                        {{ $commerce->category->name ?? 'Sin categoría' }}
                    </p>

                    <p class="text-gray-600 mt-4 max-w-3xl">
                        {{ $commerce->description ?? 'Este comercio aún no tiene descripción.' }}
                    </p>
                </div>

                <div class="bg-slate-900 text-white rounded-2xl px-6 py-4">
                    <p class="text-sm text-slate-300">Estado</p>
                    <p class="text-xl font-bold">{{ ucfirst($commerce->status) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                <div class="bg-gray-50 rounded-xl p-4 border">
                    <p class="text-sm text-gray-500">Dueño</p>
                    <p class="font-semibold text-gray-800">
                        {{ $commerce->user->name ?? 'No disponible' }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 border">
                    <p class="text-sm text-gray-500">Teléfono</p>
                    <p class="font-semibold text-gray-800">
                        {{ $commerce->phone ?? 'No registrado' }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4 border">
                    <p class="text-sm text-gray-500">Dirección</p>
                    <p class="font-semibold text-gray-800">
                        {{ $commerce->address ?? 'No registrada' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="mb-5">
            <h3 class="text-2xl font-bold text-slate-900">
                Productos disponibles
            </h3>

            <p class="text-gray-500 text-sm">
                Productos publicados por este comercio.
            </p>
        </div>

        @if ($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="h-40 bg-gray-200 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-500 text-sm">Sin imagen</span>
                            @endif
                        </div>

                        <div class="p-5">
                            <h4 class="font-bold text-lg text-slate-900">
                                {{ $product->name }}
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $product->description ?? 'Sin descripción' }}
                            </p>

                            <div class="mt-4">
                                @if ($product->discount_percentage > 0)
                                    <p class="text-sm text-gray-400 line-through">
                                        Q{{ number_format($product->price, 2) }}
                                    </p>

                                    <p class="text-xl font-bold text-green-700">
                                        Q{{ number_format($product->finalPrice(), 2) }}
                                    </p>

                                    <p class="text-xs text-green-600">
                                        {{ number_format($product->discount_percentage, 0) }}% de descuento
                                    </p>
                                @else
                                    <p class="text-xl font-bold text-slate-900">
                                        Q{{ number_format($product->price, 2) }}
                                    </p>
                                @endif
                            </div>

                            <div class="mt-4">
                                @if ($product->stock > 0)
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Stock: {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        Sin stock
                                    </span>
                                @endif
                            </div>

                            <button type="button"
                                    class="mt-5 w-full px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                                Agregar al carrito
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center">
                <h4 class="text-xl font-bold text-slate-900">
                    Este comercio aún no tiene productos
                </h4>

                <p class="text-gray-500 mt-2">
                    Cuando el comerciante agregue productos, aparecerán aquí.
                </p>
            </div>
        @endif
    </section>

</main>

</body>
</html>
