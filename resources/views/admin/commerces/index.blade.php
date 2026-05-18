@extends('admin.layouts.app')

@section('title', 'Gestión de Comercios')

@section('content')
    <div class="space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">Comercios</h1>
            <p class="text-gray-500 mt-1">
                Administra los comercios registrados en la plataforma.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="GET" action="{{ route('admin.commerces.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                    <select name="category_id"
                            id="category_id"
                            class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                        <option value="">Todas</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="status"
                            id="status"
                            class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                        <option value="">Todos</option>
                        <option value="activo" {{ $status === 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="suspendido" {{ $status === 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                        <option value="inactivo" {{ $status === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Filtrar
                    </button>

                    <a href="{{ route('admin.commerces.index') }}"
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
                        <th class="px-6 py-3">Comercio</th>
                        <th class="px-6 py-3">Dueño</th>
                        <th class="px-6 py-3">Categoría</th>
                        <th class="px-6 py-3">Teléfono</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Registro</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                    @forelse ($commerces as $commerce)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">{{ $commerce->name }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $commerce->description ?? 'Sin descripción' }}
                                </p>
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $commerce->user->name ?? 'Sin dueño' }}
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $commerce->category->name ?? 'Sin categoría' }}
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $commerce->phone ?? 'No registrado' }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($commerce->status === 'activo')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Activo
                                    </span>
                                @elseif ($commerce->status === 'suspendido')
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        Suspendido
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                        Inactivo
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $commerce->created_at->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    @if ($commerce->status !== 'suspendido')
                                        <form method="POST"
                                              action="{{ route('admin.commerces.suspend', $commerce) }}"
                                              onsubmit="return confirm('¿Seguro que deseas suspender este comercio?')">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200">
                                                Suspender
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST"
                                              action="{{ route('admin.commerces.activate', $commerce) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                                                Reactivar
                                            </button>
                                        </form>
                                    @endif

                                    @if ($commerce->status !== 'inactivo')
                                        <form method="POST"
                                              action="{{ route('admin.commerces.deactivate', $commerce) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="px-3 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                                Inactivar
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST"
                                          action="{{ route('admin.commerces.destroy', $commerce) }}"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este comercio?')">
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
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                No hay comercios registrados todavía.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $commerces->links() }}
            </div>
        </div>

    </div>
@endsection
