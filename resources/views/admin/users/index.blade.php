@extends('admin.layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
    <div class="space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">Usuarios</h1>
            <p class="text-gray-500 mt-1">
                Administra los usuarios registrados en la plataforma.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar</label>
                    <input type="text"
                           name="search"
                           id="search"
                           value="{{ $search }}"
                           placeholder="Nombre o correo"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                    <select name="role"
                            id="role"
                            class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                        <option value="">Todos</option>
                        <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="usuario" {{ $role === 'usuario' ? 'selected' : '' }}>Usuario</option>
                        <option value="comerciante" {{ $role === 'comerciante' ? 'selected' : '' }}>Comerciante</option>
                        <option value="repartidor" {{ $role === 'repartidor' ? 'selected' : '' }}>Repartidor</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="status"
                            id="status"
                            class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                        <option value="">Todos</option>
                        <option value="activo" {{ $status === 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="baneado" {{ $status === 'baneado' ? 'selected' : '' }}>Baneado</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Filtrar
                    </button>

                    <a href="{{ route('admin.users.index') }}"
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
                        <th class="px-6 py-3">Correo</th>
                        <th class="px-6 py-3">Rol</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3">Registro</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $user->name }}

                                @if ($user->id === auth()->id())
                                    <span class="ml-2 px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        Tú
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($user->role === 'admin')
                                    <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                                        Admin
                                    </span>
                                @elseif ($user->role === 'comerciante')
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        Comerciante
                                    </span>
                                @elseif ($user->role === 'repartidor')
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        Repartidor
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                        Usuario
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if ($user->status === 'activo')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Activo
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        Baneado
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">

                                    @if ($user->status === 'activo')
                                        <form method="POST"
                                              action="{{ route('admin.users.ban', $user) }}"
                                              onsubmit="return confirm('¿Seguro que deseas banear este usuario?')">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200">
                                                Banear
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST"
                                              action="{{ route('admin.users.activate', $user) }}">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                                                Reactivar
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST"
                                          action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
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
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $users->links() }}
            </div>
        </div>

    </div>
@endsection
