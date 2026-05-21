<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido #{{ $order->id }} - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Pedido #{{ $order->id }}
            </h1>

            <p class="text-sm text-gray-500">
                Detalle del pedido realizado
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('marketplace.orders.index') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Mis pedidos
            </a>

            <a href="{{ route('marketplace.home') }}"
               class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                Marketplace
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

    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Estado</p>
            <h2 class="text-xl font-bold text-slate-900 mt-2">
                {{ $order->statusLabel() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Fecha</p>
            <h2 class="text-xl font-bold text-slate-900 mt-2">
                {{ $order->created_at->format('d/m/Y') }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Total</p>
            <h2 class="text-xl font-bold text-slate-900 mt-2">
                Q{{ number_format($order->total, 2) }}
            </h2>
        </div>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-bold text-slate-900">
                Productos comprados
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 border-b">
                <tr>
                    <th class="px-6 py-3">Producto</th>
                    <th class="px-6 py-3">Comercio</th>
                    <th class="px-6 py-3">Cantidad</th>
                    <th class="px-6 py-3">Precio unitario</th>
                    <th class="px-6 py-3">Subtotal</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                @foreach ($order->items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $item->product->name ?? 'Producto eliminado' }}
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $item->commerce->name ?? 'Comercio eliminado' }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $item->quantity }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            Q{{ number_format($item->unit_price, 2) }}
                        </td>

                        <td class="px-6 py-4 font-bold text-gray-800">
                            Q{{ number_format($item->subtotal, 2) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

</main>

</body>
</html>
