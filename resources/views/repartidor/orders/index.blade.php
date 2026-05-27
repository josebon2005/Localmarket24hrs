<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedidos asignados - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Panel de repartidor</h1>
            <p class="text-sm text-gray-500">Pedidos asignados a {{ auth()->user()->name }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                Cerrar sesion
            </button>
        </form>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">
    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
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
                        <th class="px-6 py-3">Estado pedido</th>
                        <th class="px-6 py-3">Estado entrega</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-800">#{{ $order->id }}</td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">{{ $order->user->name ?? 'Sin comprador' }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email ?? 'Sin correo' }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $order->statusLabel() }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                    {{ $order->deliveryStatusLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">Q{{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('repartidor.orders.show', $order) }}"
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
            <h2 class="text-2xl font-bold text-slate-900">No tienes pedidos asignados</h2>
            <p class="text-gray-500 mt-2">Cuando admin te asigne un servicio a domicilio, aparecera aqui.</p>
        </section>
    @endif
</main>

</body>
</html>
