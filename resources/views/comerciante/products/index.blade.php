<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Productos</h1>
            <p class="text-sm text-gray-500">Administra los productos de {{ $commerce->name }}</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('comerciante.dashboard') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Dashboard
            </a>

            <a href="{{ route('comerciante.products.create') }}"
               class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                Crear producto
            </a>
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

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 border-b">
                <tr>
                    <th class="px-6 py-3">Producto</th>
                    <th class="px-6 py-3">Precio</th>
                    <th class="px-6 py-3">Descuento</th>
                    <th class="px-6 py-3">Precio final</th>
                    <th class="px-6 py-3">Stock</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-14 h-14 object-cover rounded-lg border">
                                @else
                                    <div class="w-14 h-14 rounded-lg bg-gray-200 flex items-center justify-center text-xs text-gray-500">
                                        Sin imagen
                                    </div>
                                @endif

                                <div>
                                    <p class="font-medium text-gray-800">
                                        {{ $product->name }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $product->description ?? 'Sin descripción' }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            Q{{ number_format($product->price, 2) }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ number_format($product->discount_percentage, 0) }}%
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">
                            Q{{ number_format($product->finalPrice(), 2) }}
                        </td>

                        <td class="px-6 py-4">
                            @if ($product->stock <= 0)
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                    Sin stock
                                </span>
                            @elseif ($product->stock <= 5)
                                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                    Bajo: {{ $product->stock }}
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    {{ $product->stock }}
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @if ($product->status === 'activo')
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    Activo
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                    Inactivo
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('comerciante.products.edit', $product) }}"
                                   class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200">
                                    Editar
                                </a>

                                <form method="POST" action="{{ route('comerciante.products.toggle-status', $product) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200">
                                        {{ $product->status === 'activo' ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>

                                <form method="POST"
                                      action="{{ route('comerciante.products.destroy', $product) }}"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                            Todavía no tienes productos registrados.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t">
            {{ $products->links() }}
        </div>
    </section>

</main>

</body>
</html>
