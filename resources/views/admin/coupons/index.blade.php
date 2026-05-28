@extends('admin.layouts.app')

@section('title', 'Cupones')

@section('content')
<div class="space-y-6" x-data="{ filtersOpen: false }">

    {{-- ══════ HEADER ══════ --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 text-white shadow-xl shadow-orange-500/20">
        <div class="absolute -top-10 -right-10 w-52 h-52 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-40 h-40 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black">Cupones</h1>
                    <p class="text-orange-200 text-sm mt-0.5">Gestiona descuentos y promociones de la plataforma</p>
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                {{-- Stats --}}
                <div class="text-center bg-white/20 backdrop-blur rounded-xl px-4 py-2 border border-white/20">
                    <p class="text-xl font-black">{{ $coupons->total() }}</p>
                    <p class="text-xs text-orange-200">Total</p>
                </div>
                <div class="text-center bg-green-400/30 backdrop-blur rounded-xl px-4 py-2 border border-green-300/30">
                    <p class="text-xl font-black">{{ $coupons->where('status','activo')->count() }}</p>
                    <p class="text-xs text-orange-200">Activos</p>
                </div>

                <a href="{{ route('admin.coupons.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold bg-white text-orange-700 hover:bg-orange-50 shadow-lg transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nuevo cupón
                </a>
            </div>
        </div>
    </div>

    {{-- ══════ FILTROS ══════ --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <button @click="filtersOpen = !filtersOpen"
                class="w-full flex items-center justify-between px-6 py-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filtros de búsqueda
                @if(request('search') || request('status'))
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-700">activos</span>
                @endif
            </div>
            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="filtersOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <div x-show="filtersOpen" x-collapse class="border-t border-gray-100">
            <form method="GET" action="{{ route('admin.coupons.index') }}" class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Buscar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ $search }}"
                               placeholder="Código o descripción..."
                               class="w-full pl-9 pr-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Estado</label>
                    <div class="relative">
                        <select name="status"
                                class="w-full pr-8 pl-4 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all appearance-none bg-white">
                            <option value="">Todos los estados</option>
                            <option value="activo"   {{ $status === 'activo'   ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $status === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Filtrar
                    </button>
                    <a href="{{ route('admin.coupons.index') }}"
                       class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- ══════ TABLA ══════ --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        @if($coupons->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Código</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Origen</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Descuento</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">Uso</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Vigencia</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($coupons as $coupon)
                            <tr class="hover:bg-orange-50/30 transition-colors group">

                                {{-- Código + descripción --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-orange-100 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 font-mono tracking-wide">{{ $coupon->code }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5">{{ $coupon->description ?? 'Sin descripción' }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Origen --}}
                                <td class="px-6 py-4">
                                    @if ($coupon->commerce)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                            {{ Str::limit($coupon->commerce->name, 18) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                            Plataforma
                                        </span>
                                    @endif
                                </td>

                                {{-- Descuento --}}
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-900">
                                        @if ($coupon->type === 'fixed')
                                            Q{{ number_format($coupon->value, 2) }}
                                        @else
                                            {{ number_format($coupon->value, 0) }}%
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5">Mín. Q{{ number_format($coupon->minimum_total, 2) }}</p>
                                </td>

                                {{-- Uso --}}
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $limit = $coupon->usage_limit;
                                        $used  = $coupon->used_count;
                                        $pct   = $limit ? min(100, round($used / $limit * 100)) : null;
                                    @endphp
                                    <p class="font-semibold text-gray-900 text-xs">
                                        {{ $used }} / {{ $limit ?? '∞' }}
                                    </p>
                                    @if ($limit)
                                        <div class="mt-1.5 h-1.5 w-16 mx-auto bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full rounded-full transition-all {{ $pct >= 90 ? 'bg-red-500' : ($pct >= 60 ? 'bg-amber-500' : 'bg-green-500') }}"
                                                 style="width: {{ $pct }}%"></div>
                                        </div>
                                    @endif
                                </td>

                                {{-- Vigencia --}}
                                <td class="px-6 py-4">
                                    <p class="text-gray-700 text-xs">
                                        {{ $coupon->starts_at?->format('d/m/Y') ?? 'Hoy' }}
                                    </p>
                                    <p class="text-gray-400 text-xs">
                                        hasta {{ $coupon->expires_at?->format('d/m/Y') ?? 'Sin vencimiento' }}
                                    </p>
                                </td>

                                {{-- Estado --}}
                                <td class="px-6 py-4">
                                    @if ($coupon->status === 'activo')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500 border border-gray-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                {{-- Acciones --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.coupons.edit', $coupon) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Editar
                                        </a>

                                        <form method="POST" action="{{ route('admin.coupons.toggle-status', $coupon) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors
                                                           {{ $coupon->status === 'activo'
                                                               ? 'text-amber-700 bg-amber-50 hover:bg-amber-100'
                                                               : 'text-green-700 bg-green-50 hover:bg-green-100' }}">
                                                {{ $coupon->status === 'activo' ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}"
                                              x-data
                                              @submit.prevent="if(confirm('¿Eliminar el cupón {{ addslashes($coupon->code) }}?')) $el.submit()">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($coupons->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $coupons->links() }}
                </div>
            @endif

        @else
            <div class="py-20 text-center">
                <div class="w-20 h-20 rounded-3xl bg-orange-50 flex items-center justify-center mx-auto mb-4 border-2 border-dashed border-orange-200">
                    <svg class="w-9 h-9 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg">Sin cupones</h3>
                <p class="text-gray-400 text-sm mt-1 mb-6">
                    {{ request('search') || request('status') ? 'No hay resultados para los filtros aplicados.' : 'Crea el primer cupón de descuento.' }}
                </p>
                @if(!request('search') && !request('status'))
                    <a href="{{ route('admin.coupons.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-orange-500 to-orange-600 shadow-lg shadow-orange-500/25 hover:from-orange-600 hover:to-amber-600 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Crear primer cupón
                    </a>
                @else
                    <a href="{{ route('admin.coupons.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
                        Limpiar filtros
                    </a>
                @endif
            </div>
        @endif
    </div>

</div>
@endsection
