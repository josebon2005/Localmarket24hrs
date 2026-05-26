@extends('admin.layouts.app')

@section('title', 'Comercios')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 text-white">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black">Gestión de comercios</h1>
                    <p class="text-orange-100 text-sm mt-0.5">Administra y modera los comercios de la plataforma</p>
                </div>
            </div>
            <span class="shrink-0 px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold">
                {{ $commerces->total() }} comercios
            </span>
        </div>
    </div>

    {{-- FILTROS --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <form method="GET" action="{{ route('admin.commerces.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Buscar</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Nombre o descripción…"
                       class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Categoría</label>
                <select name="category_id" class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all bg-white">
                    <option value="">Todas</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Estado</label>
                <select name="status" class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all bg-white">
                    <option value="">Todos</option>
                    <option value="activo"     {{ $status === 'activo'     ? 'selected' : '' }}>Activo</option>
                    <option value="suspendido" {{ $status === 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                    <option value="inactivo"   {{ $status === 'inactivo'   ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 transition-all">
                    Filtrar
                </button>
                <a href="{{ route('admin.commerces.index') }}" class="py-2.5 px-4 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    {{-- TABLA --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <p class="text-sm font-semibold text-gray-700">Mostrando {{ $commerces->count() }} de {{ $commerces->total() }} comercios</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3 text-left">Comercio</th>
                        <th class="px-6 py-3 text-left">Dueño</th>
                        <th class="px-6 py-3 text-left">Categoría</th>
                        <th class="px-6 py-3 text-left">Teléfono</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-left">Registro</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($commerces as $commerce)
                        <tr class="hover:bg-orange-50/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-black text-sm shrink-0">
                                        {{ strtoupper(substr($commerce->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $commerce->name }}</p>
                                        <p class="text-xs text-gray-400 truncate max-w-[180px]">{{ $commerce->description ?? 'Sin descripción' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $commerce->user->name ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @if($commerce->category)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700">
                                        {{ $commerce->category->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">Sin categoría</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $commerce->phone ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $sMap = ['activo' => 'bg-green-50 text-green-700 dot-green', 'suspendido' => 'bg-yellow-50 text-yellow-700', 'inactivo' => 'bg-gray-100 text-gray-600'];
                                    $dotMap = ['activo' => 'bg-green-400', 'suspendido' => 'bg-yellow-400', 'inactivo' => 'bg-gray-400'];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $sMap[$commerce->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $dotMap[$commerce->status] ?? 'bg-gray-400' }}"></span>
                                    {{ ucfirst($commerce->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-xs">{{ $commerce->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1.5 flex-wrap">
                                    @if($commerce->status !== 'suspendido')
                                        <form method="POST" action="{{ route('admin.commerces.suspend', $commerce) }}"
                                              onsubmit="return confirm('¿Suspender {{ $commerce->name }}?')">
                                            @csrf @method('PATCH')
                                            <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-yellow-50 text-yellow-700 hover:bg-yellow-100 border border-yellow-200 transition-colors">Suspender</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.commerces.activate', $commerce) }}">
                                            @csrf @method('PATCH')
                                            <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 transition-colors">Reactivar</button>
                                        </form>
                                    @endif
                                    @if($commerce->status !== 'inactivo')
                                        <form method="POST" action="{{ route('admin.commerces.deactivate', $commerce) }}">
                                            @csrf @method('PATCH')
                                            <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gray-100 text-gray-600 hover:bg-gray-200 border border-gray-200 transition-colors">Inactivar</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.commerces.destroy', $commerce) }}"
                                          onsubmit="return confirm('¿Eliminar {{ $commerce->name }}? Esta acción no se puede deshacer.')">
                                        @csrf @method('DELETE')
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 transition-colors">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3 border-2 border-dashed border-gray-200">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <p class="font-semibold text-gray-800">Sin comercios</p>
                                <p class="text-sm text-gray-400 mt-0.5">No se encontraron comercios con esos filtros.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($commerces->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">{{ $commerces->links() }}</div>
        @endif
    </div>

</div>
@endsection
