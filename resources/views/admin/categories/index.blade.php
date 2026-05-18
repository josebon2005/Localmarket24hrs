@extends('admin.layouts.app')

@section('title', 'Gestión de Categorías')

@section('content')
    <div class="space-y-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Categorías</h1>
                <p class="text-gray-500 mt-1">
                    Administra las categorías disponibles para los comercios.
                </p>
            </div>

            <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                Nueva categoría
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                    <input type="text"
                           name="search"
                           id="search"
                           value="{{ $search }}"
                           placeholder="Nombre o descripción"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="status"
                            id="status"
                            class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                        <option value="">Todos</option>
                        <option value="activa" {{ $status === 'activa' ? 'selected' : '' }}>Activa</option>
                        <option value="inactiva" {{ $status === 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Filtrar
                    </button>

                    <a href="{{ route('admin.categories.index') }}"
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
                        <th class="px-6 py-3">Nombre</th>
                        <th class="px-6 py-3">Descripción</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Fecha</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $category->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $category->description ?? 'Sin descripción' }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($category->status === 'activa')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Activa
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        Inactiva
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $category->created_at->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200">
                                        Editar
                                    </a>

                                    <form method="POST" action="{{ route('admin.categories.toggle-status', $category) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                                class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200">
                                            {{ $category->status === 'activa' ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('admin.categories.destroy', $category) }}"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                No hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $categories->links() }}
            </div>
        </div>

    </div>
@endsection
