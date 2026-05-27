@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- HERO BANNER NARANJA --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 sm:p-8 text-white">
        {{-- Decoraciones --}}
        <div class="absolute -top-10 -right-10 w-52 h-52 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-amber-300/20 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute top-4 right-32 w-3 h-3 bg-white/30 rounded-full"></div>
        <div class="absolute bottom-6 right-20 w-2 h-2 bg-white/20 rounded-full"></div>

        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-5">
            <div>
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium mb-3">
                    <span class="w-2 h-2 rounded-full bg-green-300 animate-pulse"></span>
                    Sistema operativo
                </div>
                <h1 class="text-2xl sm:text-3xl font-black leading-tight">
                    Bienvenido, {{ auth()->user()->name }}
                </h1>
                <p class="text-orange-100 mt-1.5 text-sm max-w-md">
                    Panel de control de LocalMarket 24hrs — resumen general de la plataforma.
                </p>
            </div>

            {{-- KPIs rápidos en el banner --}}
            <div class="flex gap-3 shrink-0">
                <div class="text-center bg-white/15 backdrop-blur-sm rounded-2xl px-5 py-3 border border-white/20">
                    <p class="text-2xl font-black">{{ $totalUsers }}</p>
                    <p class="text-xs text-orange-100 mt-0.5 font-medium">Usuarios</p>
                </div>
                <div class="text-center bg-white/15 backdrop-blur-sm rounded-2xl px-5 py-3 border border-white/20">
                    <p class="text-2xl font-black">{{ $totalCommerces }}</p>
                    <p class="text-xs text-orange-100 mt-0.5 font-medium">Comercios</p>
                </div>
                <div class="text-center bg-white/15 backdrop-blur-sm rounded-2xl px-5 py-3 border border-white/20">
                    <p class="text-2xl font-black">Q{{ number_format($totalSales, 0) }}</p>
                    <p class="text-xs text-orange-100 mt-0.5 font-medium">Ventas</p>
                </div>
            </div>
        </div>
    </div>

    {{-- MÉTRICAS PRINCIPALES --}}
    <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">

        {{-- Ventas totales (naranja destacado) --}}
        <a href="{{ route('admin.reports.index') }}" class="reveal stagger-1 col-span-2 xl:col-span-1 relative overflow-hidden group rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 p-5 shadow-lg shadow-orange-500/20 hover:shadow-xl hover:shadow-orange-500/30 hover:-translate-y-0.5 transition-all duration-200">
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="relative">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-white/25 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-white/80 bg-white/20 px-2.5 py-1 rounded-full">Ingresos</span>
                </div>
                <p class="text-3xl font-black text-white">Q{{ number_format($totalSales, 2) }}</p>
                <p class="text-sm text-orange-100 mt-1">Ventas totales generadas</p>
            </div>
        </a>

        {{-- Pedidos --}}
        <a href="{{ route('admin.reports.index') }}" class="reveal stagger-2 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-indigo-50 group-hover:bg-indigo-100 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-indigo-500 bg-indigo-50 px-2.5 py-1 rounded-full">Pedidos</span>
            </div>
            <p class="text-3xl font-black text-gray-900">{{ $totalOrders }}</p>
            <p class="text-sm text-gray-500 mt-1">
                <span class="text-amber-500 font-semibold">{{ $pendingOrders }}</span> pendientes ·
                <span class="text-green-500 font-semibold">{{ $deliveredOrders }}</span> entregados
            </p>
        </a>

        {{-- Comercios activos --}}
        <a href="{{ route('admin.commerces.index') }}" class="reveal stagger-3 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-emerald-50 group-hover:bg-emerald-100 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-emerald-500 bg-emerald-50 px-2.5 py-1 rounded-full">Comercios</span>
            </div>
            <p class="text-3xl font-black text-gray-900">{{ $totalActiveCommerces }}</p>
            <p class="text-sm text-gray-500 mt-1">
                Activos de <span class="font-semibold text-gray-700">{{ $totalCommerces }}</span> totales
                @if($totalSuspendedCommerces > 0)
                    · <span class="text-yellow-500 font-semibold">{{ $totalSuspendedCommerces }}</span> suspendidos
                @endif
            </p>
        </a>

        {{-- Usuarios --}}
        <a href="{{ route('admin.users.index') }}" class="reveal stagger-4 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl bg-blue-50 group-hover:bg-blue-100 flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-blue-500 bg-blue-50 px-2.5 py-1 rounded-full">Usuarios</span>
            </div>
            <p class="text-3xl font-black text-gray-900">{{ $totalUsers }}</p>
            <p class="text-sm text-gray-500 mt-1">
                @if($totalBannedUsers > 0)
                    <span class="text-red-500 font-semibold">{{ $totalBannedUsers }}</span> baneados ·
                @endif
                <span class="text-purple-500 font-semibold">{{ $totalAdmins }}</span> admins
            </p>
        </a>

    </div>

    {{-- FILA INFERIOR DE MÉTRICAS --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

        @php
            $miniCards = [
                ['label' => 'Categorías activas',    'value' => $totalActiveCategories,  'of' => $totalCategories,    'color' => 'orange', 'route' => 'admin.categories.index', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                ['label' => 'Productos activos',     'value' => $totalActiveProducts,     'of' => $totalProducts,      'color' => 'sky',    'route' => 'admin.reports.index',    'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                ['label' => 'Bajo stock',             'value' => $lowStockProducts,        'of' => null,                'color' => 'red',    'route' => 'admin.reports.index',    'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                ['label' => 'Administradores',        'value' => $totalAdmins,             'of' => null,                'color' => 'purple', 'route' => 'admin.users.index',      'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
            ];
            $colorMap = [
                'orange' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-500', 'bar' => 'bg-orange-400'],
                'sky'    => ['bg' => 'bg-sky-50',    'text' => 'text-sky-500',    'bar' => 'bg-sky-400'],
                'red'    => ['bg' => 'bg-red-50',    'text' => 'text-red-500',    'bar' => 'bg-red-400'],
                'purple' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-500', 'bar' => 'bg-purple-400'],
            ];
        @endphp

        @foreach($miniCards as $i => $card)
            @php $c = $colorMap[$card['color']]; @endphp
            <a href="{{ route($card['route']) }}" class="reveal stagger-{{ $i + 1 }} group bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl {{ $c['bg'] }} flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 {{ $c['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/>
                        </svg>
                    </div>
                    <p class="text-xs font-medium text-gray-500 leading-tight">{{ $card['label'] }}</p>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $card['value'] }}</p>
                @if($card['of'])
                    @php $pct = $card['of'] > 0 ? round(($card['value'] / $card['of']) * 100) : 0; @endphp
                    <div class="mt-2">
                        <div class="flex justify-between text-xs text-gray-400 mb-1">
                            <span>de {{ $card['of'] }}</span>
                            <span>{{ $pct }}%</span>
                        </div>
                        <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full {{ $c['bar'] }} rounded-full transition-all duration-700" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                @endif
            </a>
        @endforeach

    </div>

    {{-- TABLA + ACCIONES RÁPIDAS --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Tabla de últimos pedidos --}}
        <div class="reveal xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="font-bold text-gray-900">Últimos pedidos</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Actividad reciente de compradores</p>
                </div>
                <a href="{{ route('admin.reports.index') }}"
                   class="inline-flex items-center gap-1 text-xs font-semibold text-orange-500 hover:text-orange-600 transition-colors">
                    Ver todo
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="divide-y divide-gray-50">
                    @foreach($recentOrders as $order)
                        @php
                            $sc = [
                                'pendiente'      => ['label' => 'Pendiente',      'class' => 'bg-yellow-50 text-yellow-700'],
                                'confirmado'     => ['label' => 'Confirmado',     'class' => 'bg-blue-50 text-blue-700'],
                                'en_preparacion' => ['label' => 'En preparación', 'class' => 'bg-indigo-50 text-indigo-700'],
                                'en_camino'      => ['label' => 'En camino',      'class' => 'bg-purple-50 text-purple-700'],
                                'entregado'      => ['label' => 'Entregado',      'class' => 'bg-green-50 text-green-700'],
                                'cancelado'      => ['label' => 'Cancelado',      'class' => 'bg-red-50 text-red-700'],
                            ][$order->status] ?? ['label' => $order->statusLabel(), 'class' => 'bg-gray-50 text-gray-700'];
                        @endphp
                        <div class="flex items-center gap-4 px-6 py-3.5 hover:bg-orange-50/40 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-bold text-xs shrink-0">
                                {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{ $order->user->name ?? 'Sin comprador' }}
                                </p>
                                <p class="text-xs text-gray-400">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $sc['class'] }} shrink-0">
                                {{ $sc['label'] }}
                            </span>
                            <p class="font-black text-gray-900 text-sm shrink-0 w-20 text-right">
                                Q{{ number_format($order->total, 2) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-14 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3 border-2 border-dashed border-gray-200">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-800">Aún no hay pedidos</p>
                    <p class="text-sm text-gray-400 mt-0.5">Aparecerán aquí cuando los compradores confirmen compras.</p>
                </div>
            @endif
        </div>

        {{-- Acciones rápidas --}}
        <div class="reveal space-y-3">
            <h2 class="font-bold text-gray-900 px-1">Acciones rápidas</h2>

            @php
                $actions = [
                    ['route' => 'admin.users.index',        'label' => 'Gestionar usuarios',    'sub' => $totalUsers . ' registrados',         'bg' => 'from-blue-500 to-blue-600',    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                    ['route' => 'admin.commerces.index',    'label' => 'Ver comercios',         'sub' => $totalCommerces . ' registrados',      'bg' => 'from-emerald-500 to-emerald-600', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ['route' => 'admin.categories.index',   'label' => 'Categorías',            'sub' => $totalActiveCategories . ' activas',   'bg' => 'from-orange-500 to-amber-500', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                    ['route' => 'admin.reports.index',      'label' => 'Reportes',              'sub' => 'Ver estadísticas',                    'bg' => 'from-indigo-500 to-indigo-600','icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ['route' => 'admin.admin-users.create', 'label' => 'Crear administrador',  'sub' => 'Nuevo acceso admin',                  'bg' => 'from-purple-500 to-purple-600','icon' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z'],
                ];
            @endphp

            @foreach($actions as $i => $action)
                <a href="{{ route($action['route']) }}"
                   class="stagger-{{ $i + 1 }} group flex items-center gap-3 p-3.5 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br {{ $action['bg'] }} flex items-center justify-center shadow-sm shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-4.5 h-4.5 text-white w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 group-hover:text-orange-600 transition-colors">{{ $action['label'] }}</p>
                        <p class="text-xs text-gray-400">{{ $action['sub'] }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-orange-400 group-hover:translate-x-0.5 transition-all shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endforeach
        </div>

    </div>

</div>
@endsection
