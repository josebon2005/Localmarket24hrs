@extends('admin.layouts.app')

@section('title', 'Dashboard Administrativo')

@section('content')
    <div class="space-y-6">

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Bienvenido al panel administrativo
            </h1>

            <p class="text-gray-500 mt-2">
                Desde aquí puedes ver el resumen general de LocalMarket 24hrs.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Usuarios registrados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</h3>
                <p class="text-xs text-gray-400 mt-2">Total de usuarios en la plataforma</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Administradores</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalAdmins }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios con rol administrador</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Usuarios baneados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalBannedUsers }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios restringidos</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categorías</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCategories }}</h3>
                <p class="text-xs text-gray-400 mt-2">Categorías registradas</p>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categorías activas</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalActiveCategories }}</h3>
                <p class="text-xs text-gray-400 mt-2">Disponibles para comercios</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios creados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Negocios registrados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios activos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalActiveCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Negocios habilitados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios suspendidos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalSuspendedCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Negocios restringidos</p>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Productos registrados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</h3>
                <p class="text-xs text-gray-400 mt-2">Productos creados por comerciantes</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Productos activos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalActiveProducts }}</h3>
                <p class="text-xs text-gray-400 mt-2">Productos visibles para compradores</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Productos con bajo stock</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $lowStockProducts }}</h3>
                <p class="text-xs text-gray-400 mt-2">Productos con 5 unidades o menos</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Pedidos realizados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalOrders }}</h3>
                <p class="text-xs text-gray-400 mt-2">Pedidos creados por compradores</p>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Pedidos pendientes</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingOrders }}</h3>
                <p class="text-xs text-gray-400 mt-2">Pedidos aún sin completar</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Pedidos entregados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $deliveredOrders }}</h3>
                <p class="text-xs text-gray-400 mt-2">Pedidos finalizados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Ventas generales</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">
                    Q{{ number_format($totalSales, 2) }}
                </h3>
                <p class="text-xs text-gray-400 mt-2">Total vendido en la plataforma</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Estado del sistema</p>
                <h3 class="text-3xl font-bold text-green-700 mt-2">Activo</h3>
                <p class="text-xs text-gray-400 mt-2">Sistema funcionando correctamente</p>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-800">
                    Últimos pedidos realizados
                </h2>
            </div>

            @if ($recentOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 border-b">
                        <tr>
                            <th class="px-6 py-3">Pedido</th>
                            <th class="px-6 py-3">Comprador</th>
                            <th class="px-6 py-3">Estado</th>
                            <th class="px-6 py-3">Total</th>
                            <th class="px-6 py-3">Fecha</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                        @foreach ($recentOrders as $order)
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
                                    Q{{ number_format($order->total, 2) }}
                                </td>

                                <td class="px-6 py-4 text-gray-500">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center">
                    <h3 class="text-lg font-bold text-gray-800">
                        Aún no hay pedidos registrados
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Cuando los compradores confirmen pedidos, aparecerán aquí.
                    </p>
                </div>
            @endif
        </div>

    </div>
@endsection
