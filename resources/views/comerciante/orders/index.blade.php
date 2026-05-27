<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedidos recibidos - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Pedidos recibidos</h1>
            <p class="text-sm text-gray-500">Pedidos realizados a {{ $commerce->name }}</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('comerciante.dashboard') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Dashboard
            </a>

            <a href="{{ route('comerciante.products.index') }}"
               class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                Productos
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

    @if ($orders->count() > 0)
        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 border-b">
                    <tr>
                        <th class="px-6 py-3">Pedido</th>
                        <th class="px-6 py-3">Comprador</th>
                        <th class="px-6 py-3">Productos de tu comercio</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Entrega</th>
                        <th class="px-6 py-3">Total de tu comercio</th>
                        <th class="px-6 py-3">Fecha</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                    @foreach ($orders as $order)
                        @php
                            $commerceSubtotal = $order->items->sum('subtotal');
                            $commerceQuantity = $order->items->sum('quantity');
                        @endphp

                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                #{{ $order->id }}
                            </td>

                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">
                                    {{ $order->user->name ?? 'Sin comprador' }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $order->user->email ?? 'Sin correo' }}
                                </p>
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $commerceQuantity }} producto(s)
                            </td>

                            <td class="px-6 py-4">
                                @if ($order->status === 'pendiente')
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        {{ $order->statusLabel() }}
                                    </span>
                                @elseif ($order->status === 'entregado')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        {{ $order->statusLabel() }}
                                    </span>
                                @elseif ($order->status === 'cancelado')
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        {{ $order->statusLabel() }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        {{ $order->statusLabel() }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                <p>{{ $order->deliveryStatusLabel() }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $order->deliveryUser->name ?? 'Sin repartidor' }}
                                </p>
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
                                    Ver detalle
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $orders->links() }}
            </div>
        </section>
    @else
        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-10 text-center">
            <h2 class="text-2xl font-bold text-slate-900">
                Todavía no tienes pedidos recibidos
            </h2>

            <p class="text-gray-500 mt-2">
                Cuando un comprador compre productos de tu comercio, aparecerán aquí.
            </p>

            <a href="{{ route('comerciante.products.index') }}"
               class="inline-block mt-6 px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                Ver productos
            </a>
        </section>
    @endif

</main>

</body>
</html>
