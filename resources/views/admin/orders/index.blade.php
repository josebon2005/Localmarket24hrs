@extends('admin.layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 text-white">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black">Gestión de pedidos</h1>
                    <p class="text-orange-100 text-sm mt-0.5">Monitorea todos los pedidos de la plataforma</p>
                </div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <div class="text-center bg-white/20 backdrop-blur rounded-xl px-4 py-2 border border-white/20">
                    <p class="text-xl font-black">{{ $counts['total'] }}</p>
                    <p class="text-xs text-orange-100">Total</p>
                </div>
                <div class="text-center bg-amber-400/30 backdrop-blur rounded-xl px-4 py-2 border border-amber-300/30">
                    <p class="text-xl font-black">{{ $counts['pendiente'] }}</p>
                    <p class="text-xs text-orange-100">Pendientes</p>
                </div>
                <div class="text-center bg-green-400/30 backdrop-blur rounded-xl px-4 py-2 border border-green-300/30">
                    <p class="text-xl font-black">{{ $counts['entregado'] }}</p>
                    <p class="text-xs text-orange-100">Entregados</p>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTROS RÁPIDOS --}}
    <div class="reveal flex flex-wrap gap-2">
        @php
            $quickFilters = [
                ''               => ['label' => 'Todos',          'count' => $counts['total'],          'color' => 'bg-gray-100 text-gray-700 hover:bg-gray-200'],
                'pendiente'      => ['label' => 'Pendientes',     'count' => $counts['pendiente'],      'color' => 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200'],
                'confirmado'     => ['label' => 'Confirmados',    'count' => $counts['confirmado'],     'color' => 'bg-blue-100 text-blue-800 hover:bg-blue-200'],
                'en_preparacion' => ['label' => 'En preparación', 'count' => $counts['en_preparacion'], 'color' => 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'],
                'en_camino'      => ['label' => 'En camino',      'count' => $counts['en_camino'],      'color' => 'bg-purple-100 text-purple-800 hover:bg-purple-200'],
                'entregado'      => ['label' => 'Entregados',     'count' => $counts['entregado'],      'color' => 'bg-green-100 text-green-800 hover:bg-green-200'],
                'cancelado'      => ['label' => 'Cancelados',     'count' => $counts['cancelado'],      'color' => 'bg-red-100 text-red-800 hover:bg-red-200'],
            ];
        @endphp
        @foreach($quickFilters as $val => $cfg)
            <a href="{{ route('admin.orders.index', array_filter(['status' => $val, 'search' => $search])) }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all {{ $cfg['color'] }}
                      {{ ($status ?? '') === $val ? 'ring-2 ring-offset-1 ring-orange-400 shadow-sm' : '' }}">
                {{ $cfg['label'] }}
                <span class="px-1.5 py-0.5 rounded-full bg-white/60 text-xs font-bold">{{ $cfg['count'] }}</span>
            </a>
        @endforeach
    </div>

    {{-- BUSCADOR --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input type="hidden" name="status" value="{{ $status }}">
            <div class="flex-1 relative">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ $search }}"
                       placeholder="Buscar por ID de pedido, nombre o email del comprador…"
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all">
            </div>
            <button type="submit"
                    class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 transition-all shrink-0">
                Buscar
            </button>
            @if($search || $status)
                <a href="{{ route('admin.orders.index') }}"
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all shrink-0 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Limpiar
                </a>
            @endif
        </form>
    </div>

    {{-- TABLA --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">#Pedido</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Comprador</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Comercio(s)</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Artículos</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($orders as $order)
                            @php
                                $scMap = [
                                    'pendiente'      => ['label' => 'Pendiente',      'class' => 'bg-yellow-50 text-yellow-700 border-yellow-200',  'dot' => 'bg-yellow-400'],
                                    'confirmado'     => ['label' => 'Confirmado',     'class' => 'bg-blue-50 text-blue-700 border-blue-200',        'dot' => 'bg-blue-400'],
                                    'en_preparacion' => ['label' => 'En preparación', 'class' => 'bg-indigo-50 text-indigo-700 border-indigo-200',  'dot' => 'bg-indigo-400'],
                                    'en_camino'      => ['label' => 'En camino',      'class' => 'bg-purple-50 text-purple-700 border-purple-200',  'dot' => 'bg-purple-400'],
                                    'entregado'      => ['label' => 'Entregado',      'class' => 'bg-green-50 text-green-700 border-green-200',     'dot' => 'bg-green-400'],
                                    'cancelado'      => ['label' => 'Cancelado',      'class' => 'bg-red-50 text-red-700 border-red-200',           'dot' => 'bg-red-400'],
                                ];
                                $sc = $scMap[$order->status] ?? ['label' => $order->statusLabel(), 'class' => 'bg-gray-50 text-gray-600 border-gray-200', 'dot' => 'bg-gray-400'];
                                $commerceNames = $order->items->map(fn($i) => $i->product->commerce->name ?? null)->filter()->unique()->values();
                            @endphp
                            <tr class="hover:bg-orange-50/30 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-black text-gray-900">#{{ $order->id }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-800 truncate max-w-[150px]">
                                        {{ $order->user->name ?? 'Sin comprador' }}
                                    </p>
                                    <p class="text-xs text-gray-400 truncate max-w-[150px]">
                                        {{ $order->user->email ?? '' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-0.5">
                                        @foreach($commerceNames->take(2) as $name)
                                            <span class="text-xs text-gray-600 truncate max-w-[140px]">{{ $name }}</span>
                                        @endforeach
                                        @if($commerceNames->count() > 2)
                                            <span class="text-xs text-gray-400">+{{ $commerceNames->count() - 2 }} más</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600 text-center">
                                    {{ $order->items->sum('quantity') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-black text-gray-900">Q{{ number_format($order->total, 2) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $sc['class'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }}"></span>
                                        {{ $sc['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">
                                    {{ $order->created_at->format('d/m/Y') }}<br>
                                    <span class="text-gray-400">{{ $order->created_at->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-md shadow-orange-500/20 transition-all">
                                        Ver
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $orders->links() }}
                </div>
            @endif

        @else
            <div class="py-20 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-4 border-2 border-dashed border-gray-200">
                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="font-semibold text-gray-800">No se encontraron pedidos</p>
                <p class="text-sm text-gray-400 mt-1">
                    @if($search || $status)
                        Intenta con otros filtros o
                        <a href="{{ route('admin.orders.index') }}" class="text-orange-500 hover:underline">ver todos</a>.
                    @else
                        Aún no hay pedidos registrados en la plataforma.
                    @endif
                </p>
            </div>
        @endif
    </div>

</div>
@endsection
