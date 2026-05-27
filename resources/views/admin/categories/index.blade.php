@extends('admin.layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 text-white">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black">Gestión de categorías</h1>
                    <p class="text-orange-100 text-sm mt-0.5">Administra las categorías disponibles para los comercios</p>
                </div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <span class="px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold">
                    {{ $categories->total() }} categorías
                </span>
                <a href="{{ route('admin.categories.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-white text-orange-600 rounded-xl text-sm font-bold hover:bg-orange-50 transition-colors shadow-lg shadow-black/10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva categoría
                </a>
            </div>
        </div>
    </div>

    {{-- FILTROS --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Buscar</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Nombre o descripción…"
                       class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Estado</label>
                <select name="status" class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all bg-white">
                    <option value="">Todos</option>
                    <option value="activa"   {{ $status === 'activa'   ? 'selected' : '' }}>Activa</option>
                    <option value="inactiva" {{ $status === 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                </select>
            </div>
            <div class="sm:col-span-3 flex gap-2">
                <button type="submit" class="py-2.5 px-5 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 transition-all">
                    Filtrar
                </button>
                <a href="{{ route('admin.categories.index') }}" class="py-2.5 px-5 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    {{-- TABLA --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <p class="text-sm font-semibold text-gray-700">Mostrando {{ $categories->count() }} de {{ $categories->total() }} categorías</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3 text-left">Categoría</th>
                        <th class="px-6 py-3 text-left">Descripción</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-left">Registro</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                        <tr class="hover:bg-orange-50/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-black text-sm shrink-0">
                                        {{ strtoupper(substr($category->name, 0, 1)) }}
                                    </div>
                                    <p class="font-semibold text-gray-900">{{ $category->name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs max-w-[240px] truncate">
                                {{ $category->description ?? 'Sin descripción' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($category->status === 'activa')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>Activa
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Inactiva
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-xs">{{ $category->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-1.5 flex-wrap">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 transition-colors">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.toggle-status', $category) }}">
                                        @csrf @method('PATCH')
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-semibold border transition-colors
                                            {{ $category->status === 'activa'
                                                ? 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100 border-yellow-200'
                                                : 'bg-green-50 text-green-700 hover:bg-green-100 border-green-200' }}">
                                            {{ $category->status === 'activa' ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                          onsubmit="return confirm('¿Eliminar la categoría {{ $category->name }}? Esta acción no se puede deshacer.')">
                                        @csrf @method('DELETE')
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 transition-colors">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3 border-2 border-dashed border-gray-200">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-gray-800">Sin categorías</p>
                                <p class="text-sm text-gray-400 mt-0.5">No se encontraron categorías con esos filtros.</p>
                                <a href="{{ route('admin.categories.create') }}" class="mt-4 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                    Crear primera categoría
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">{{ $categories->links() }}</div>
        @endif
    </div>

</div>
@endsection
