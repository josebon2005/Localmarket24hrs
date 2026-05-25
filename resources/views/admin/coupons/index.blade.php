@extends('admin.layouts.app')

@section('title', 'Gestión de Cupones')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Cupones</h1>
                <p class="text-gray-500 mt-1">Administra descuentos para incentivar compras.</p>
            </div>

            <a href="{{ route('admin.coupons.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                Nuevo cupón
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="GET" action="{{ route('admin.coupons.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                    <input type="text" name="search" id="search" value="{{ $search }}"
                           placeholder="Código o descripción"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="status" id="status"
                            class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                        <option value="">Todos</option>
                        <option value="activo" {{ $status === 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ $status === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.coupons.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 border-b">
                    <tr>
                        <th class="px-6 py-3">Código</th>
                        <th class="px-6 py-3">Origen</th>
                        <th class="px-6 py-3">Descuento</th>
                        <th class="px-6 py-3">Uso</th>
                        <th class="px-6 py-3">Vigencia</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                    @forelse ($coupons as $coupon)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-800">{{ $coupon->code }}</p>
                                <p class="text-xs text-gray-500">{{ $coupon->description ?? 'Sin descripción' }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                @if ($coupon->commerce)
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        {{ $coupon->commerce->name }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-700">
                                        LocalMarket
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                @if ($coupon->type === 'fixed')
                                    Q{{ number_format($coupon->value, 2) }}
                                @else
                                    {{ number_format($coupon->value, 0) }}%
                                @endif
                                <p class="text-xs text-gray-500">Mínimo Q{{ number_format($coupon->minimum_total, 2) }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $coupon->used_count }} / {{ $coupon->usage_limit ?? 'Sin límite' }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $coupon->starts_at?->format('d/m/Y') ?? 'Hoy' }}
                                -
                                {{ $coupon->expires_at?->format('d/m/Y') ?? 'Sin vencimiento' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs rounded-full {{ $coupon->status === 'activo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($coupon->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.coupons.edit', $coupon) }}"
                                       class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.coupons.toggle-status', $coupon) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200">
                                            {{ $coupon->status === 'activo' ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este cupón?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                No hay cupones registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">{{ $coupons->links() }}</div>
        </div>
    </div>
@endsection
