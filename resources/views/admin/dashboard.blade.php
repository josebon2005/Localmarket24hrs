@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Welcome banner --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-800 via-slate-900 to-gray-900 p-6 sm:p-8 text-white">
        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-amber-500/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl pointer-events-none"></div>

        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-orange-400 text-sm font-semibold mb-1">Bienvenido de vuelta</p>
                <h1 class="text-2xl sm:text-3xl font-black">{{ auth()->user()->name }}</h1>
                <p class="text-slate-400 mt-1.5 text-sm">Aquí tienes el resumen general de LocalMarket 24hrs.</p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <div class="text-right hidden sm:block">
                    <p class="text-xs text-slate-400">Sistema</p>
                    <p class="text-sm font-bold text-green-400">● Operativo</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center text-white font-black text-2xl shadow-xl shadow-orange-500/20">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </div>

    {{-- USUARIOS --}}
    <div>
        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Usuarios</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="reveal stagger-1 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-blue-500 bg-blue-50 px-2 py-0.5 rounded-full">Total</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalUsers }}</p>
                <p class="text-sm text-gray-500 mt-1">Usuarios registrados</p>
            </div>

            <div class="reveal stagger-2 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-purple-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-purple-500 bg-purple-50 px-2 py-0.5 rounded-full">Admins</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalAdmins }}</p>
                <p class="text-sm text-gray-500 mt-1">Administradores</p>
            </div>

            <div class="reveal stagger-3 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-red-500 bg-red-50 px-2 py-0.5 rounded-full">Restringidos</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalBannedUsers }}</p>
                <p class="text-sm text-gray-500 mt-1">Usuarios baneados</p>
            </div>

            <div class="reveal stagger-4 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-orange-500 bg-orange-50 px-2 py-0.5 rounded-full">Categorías</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalCategories }}</p>
                <p class="text-sm text-gray-500 mt-1">Categorías ({{ $totalActiveCategories }} activas)</p>
            </div>

        </div>
    </div>

    {{-- COMERCIOS --}}
    <div>
        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Comercios</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="reveal stagger-1 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">Total</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalCommerces }}</p>
                <p class="text-sm text-gray-500 mt-1">Comercios registrados</p>
            </div>

            <div class="reveal stagger-2 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-green-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-0.5 rounded-full">Activos</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalActiveCommerces }}</p>
                <p class="text-sm text-gray-500 mt-1">Comercios habilitados</p>
            </div>

            <div class="reveal stagger-3 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-yellow-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-yellow-600 bg-yellow-50 px-2 py-0.5 rounded-full">Suspendidos</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalSuspendedCommerces }}</p>
                <p class="text-sm text-gray-500 mt-1">Comercios suspendidos</p>
            </div>

            <div class="reveal stagger-4 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-sky-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-sky-500 bg-sky-50 px-2 py-0.5 rounded-full">Productos</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalProducts }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $totalActiveProducts }} activos · <span class="text-red-500">{{ $lowStockProducts }} bajo stock</span></p>
            </div>

        </div>
    </div>

    {{-- VENTAS --}}
    <div>
        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Pedidos y ventas</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="reveal stagger-1 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-indigo-500 bg-indigo-50 px-2 py-0.5 rounded-full">Total</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $totalOrders }}</p>
                <p class="text-sm text-gray-500 mt-1">Pedidos realizados</p>
            </div>

            <div class="reveal stagger-2 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">Pendientes</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $pendingOrders }}</p>
                <p class="text-sm text-gray-500 mt-1">Pedidos pendientes</p>
            </div>

            <div class="reveal stagger-3 group bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-teal-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-teal-500 bg-teal-50 px-2 py-0.5 rounded-full">Entregados</span>
                </div>
                <p class="text-3xl font-black text-gray-900">{{ $deliveredOrders }}</p>
                <p class="text-sm text-gray-500 mt-1">Pedidos entregados</p>
            </div>

            <div class="reveal stagger-4 group relative overflow-hidden rounded-2xl p-5 shadow-sm border border-orange-200 bg-gradient-to-br from-orange-500 to-amber-500 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="flex items-start justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-white/80 bg-white/20 px-2 py-0.5 rounded-full">Ventas</span>
                </div>
                <p class="text-3xl font-black text-white">Q{{ number_format($totalSales, 2) }}</p>
                <p class="text-sm text-orange-100 mt-1">Ventas totales</p>
            </div>

        </div>
    </div>

    {{-- RECENT ORDERS TABLE --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <div>
                <h2 class="text-base font-bold text-gray-900">Últimos pedidos</h2>
                <p class="text-xs text-gray-400 mt-0.5">Pedidos más recientes de la plataforma</p>
            </div>
            <a href="{{ route('admin.reports.index') }}"
               class="text-xs font-semibold text-orange-500 hover:text-orange-600 transition-colors flex items-center gap-1">
                Ver reporte completo
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @if($recentOrders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-xs text-gray-500 font-semibold uppercase tracking-wider">
                            <th class="px-6 py-3 text-left">Pedido</th>
                            <th class="px-6 py-3 text-left">Comprador</th>
                            <th class="px-6 py-3 text-left">Estado</th>
                            <th class="px-6 py-3 text-left">Total</th>
                            <th class="px-6 py-3 text-left">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recentOrders as $order)
                            @php
                                $statusColors = [
                                    'pendiente'      => 'bg-yellow-50 text-yellow-700',
                                    'confirmado'     => 'bg-blue-50 text-blue-700',
                                    'en_preparacion' => 'bg-indigo-50 text-indigo-700',
                                    'en_camino'      => 'bg-purple-50 text-purple-700',
                                    'entregado'      => 'bg-green-50 text-green-700',
                                    'cancelado'      => 'bg-red-50 text-red-700',
                                ];
                                $color = $statusColors[$order->status] ?? 'bg-gray-50 text-gray-700';
                            @endphp
                            <tr class="hover:bg-orange-50/30 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900">#{{ $order->id }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-slate-400 to-slate-600 flex items-center justify-center text-white font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="text-gray-700">{{ $order->user->name ?? 'Sin comprador' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                        {{ $order->statusLabel() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Q{{ number_format($order->total, 2) }}
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-4 border-2 border-dashed border-gray-200">
                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="font-semibold text-gray-900">Aún no hay pedidos</p>
                <p class="text-sm text-gray-400 mt-1">Aparecerán aquí cuando los compradores confirmen compras.</p>
            </div>
        @endif
    </div>

    {{-- QUICK ACTIONS --}}
    <div class="reveal grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
        <a href="{{ route('admin.users.index') }}"
           class="group flex flex-col items-center gap-2 p-4 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-blue-50 group-hover:bg-blue-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="text-xs font-semibold text-gray-700">Usuarios</span>
        </a>
        <a href="{{ route('admin.commerces.index') }}"
           class="group flex flex-col items-center gap-2 p-4 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 group-hover:bg-emerald-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <span class="text-xs font-semibold text-gray-700">Comercios</span>
        </a>
        <a href="{{ route('admin.categories.index') }}"
           class="group flex flex-col items-center gap-2 p-4 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-orange-50 group-hover:bg-orange-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <span class="text-xs font-semibold text-gray-700">Categorías</span>
        </a>
        <a href="{{ route('admin.reports.index') }}"
           class="group flex flex-col items-center gap-2 p-4 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 group-hover:bg-indigo-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <span class="text-xs font-semibold text-gray-700">Reportes</span>
        </a>
        <a href="{{ route('admin.admin-users.create') }}"
           class="group flex flex-col items-center gap-2 p-4 bg-white rounded-2xl shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md transition-all text-center">
            <div class="w-10 h-10 rounded-xl bg-purple-50 group-hover:bg-purple-100 flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <span class="text-xs font-semibold text-gray-700">Nuevo admin</span>
        </a>
    </div>

</div>
@endsection
