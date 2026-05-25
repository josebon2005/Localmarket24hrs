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

            <a href="{{ route('marketplace.cart.index') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Carrito
            </a>

            <a href="{{ route('marketplace.orders.index') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Mis pedidos
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
            Desde este panel puedes administrar tu comercio, productos, inventario y pedidos recibidos.
        </p>
    </section>

    @if (auth()->user()->commerce)
        @php
            $commerce = auth()->user()->commerce;

            $totalProducts = $commerce->products()->count();

            $lowStockProducts = $commerce->products()
                ->where('stock', '<=', 5)
                ->count();

            $receivedOrders = \App\Models\Order::whereHas('items', function ($query) use ($commerce) {
                    $query->where('commerce_id', $commerce->id);
                })
                ->count();

            $totalSales = \App\Models\OrderItem::where('commerce_id', $commerce->id)
                ->sum('subtotal');

            $recentOrders = \App\Models\Order::whereHas('items', function ($query) use ($commerce) {
                    $query->where('commerce_id', $commerce->id);
                })
                ->with([
                    'user',
                    'items' => function ($query) use ($commerce) {
                        $query->where('commerce_id', $commerce->id)
                            ->with('product');
                    }
                ])
                ->latest()
                ->take(5)
                ->get();
        @endphp

        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Nombre del comercio</p>
                <h3 class="text-xl font-bold text-slate-900 mt-2">
                    {{ $commerce->name }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Estado</p>
                <h3 class="text-xl font-bold text-slate-900 mt-2">
                    {{ ucfirst($commerce->status) }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categoría</p>
                <h3 class="text-xl font-bold text-slate-900 mt-2">
                    {{ $commerce->category->name ?? 'Sin categoría' }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Productos</p>
                <h3 class="text-xl font-bold text-slate-900 mt-2">
                    {{ $totalProducts }}
                </h3>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Pedidos recibidos</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $receivedOrders }}
                </h3>
                <p class="text-xs text-gray-400 mt-2">
                    Pedidos donde compraron productos de tu comercio
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Ventas totales</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">
                    Q{{ number_format($totalSales, 2) }}
                </h3>
                <p class="text-xs text-gray-400 mt-2">
                    Total vendido en pedidos
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Bajo stock</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $lowStockProducts }}
                </h3>
                <p class="text-xs text-gray-400 mt-2">
                    Productos con 5 unidades o menos
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Inventario</p>
                <h3 class="text-3xl font-bold text-slate-900 mt-2">
                    {{ $commerce->products()->sum('stock') }}
                </h3>
                <p class="text-xs text-gray-400 mt-2">
                    Unidades totales disponibles
                </p>
            </div>
        </section>

        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8">
            <h3 class="text-xl font-bold text-slate-900">
                Gestión del comercio
            </h3>

            <p class="text-gray-500 mt-2">
                Administra tus productos, inventario y pedidos recibidos.
            </p>

            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('comerciante.products.index') }}"
                   class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                    Ver productos
                </a>

                <a href="{{ route('comerciante.products.create') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Crear producto
                </a>

                <a href="{{ route('comerciante.orders.index') }}"
                   class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200">
                    Pedidos recibidos
                </a>

                <a href="{{ route('comerciante.coupons.index') }}"
                   class="px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                    Cupones
                </a>

                <a href="{{ route('comerciante.conversations.index') }}"
                   class="px-4 py-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200">
                    Chats
                </a>
            </div>
        </section>

        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-bold text-slate-900">
                    Últimos pedidos recibidos
                </h3>
            </div>

            @if ($recentOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 border-b">
                        <tr>
                            <th class="px-6 py-3">Pedido</th>
                            <th class="px-6 py-3">Comprador</th>
                            <th class="px-6 py-3">Estado</th>
                            <th class="px-6 py-3">Total de tu comercio</th>
                            <th class="px-6 py-3">Fecha</th>
                            <th class="px-6 py-3 text-right">Acción</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                        @foreach ($recentOrders as $order)
                            @php
                                $commerceSubtotal = $order->items->sum('subtotal');
                            @endphp

                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    #{{ $order->id }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $order->user->name ?? 'Sin comprador' }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        {{ $order->statusLabel() }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 font-bold text-gray-800">
                                    Q{{ number_format($commerceSubtotal, 2) }}
                                </td>

                                <td class="px-6 py-4 text-gray-500">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('comerciante.orders.show', $order) }}"
                                       class="px-3 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center">
                    <h4 class="text-lg font-bold text-slate-900">
                        Aún no tienes pedidos recibidos
                    </h4>

                    <p class="text-gray-500 mt-2">
                        Cuando alguien compre tus productos, aparecerán aquí.
                    </p>
                </div>
            @endif
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
