@extends('admin.layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 text-white">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black">Gestión de usuarios</h1>
                    <p class="text-orange-100 text-sm mt-0.5">Administra los usuarios registrados en la plataforma</p>
                </div>
            </div>
            <div class="shrink-0">
                <span class="px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold">
                    {{ $users->total() }} usuarios
                </span>
            </div>
        </div>
    </div>

    {{-- FILTROS --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Buscar</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Nombre o correo…"
                       class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Rol</label>
                <select name="role" class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all bg-white">
                    <option value="">Todos</option>
                    <option value="admin"       {{ $role === 'admin'       ? 'selected' : '' }}>Admin</option>
                    <option value="usuario"     {{ $role === 'usuario'     ? 'selected' : '' }}>Usuario</option>
                    <option value="comerciante" {{ $role === 'comerciante' ? 'selected' : '' }}>Comerciante</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Estado</label>
                <select name="status" class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all bg-white">
                    <option value="">Todos</option>
                    <option value="activo"  {{ $status === 'activo'  ? 'selected' : '' }}>Activo</option>
                    <option value="baneado" {{ $status === 'baneado' ? 'selected' : '' }}>Baneado</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit"
                        class="flex-1 py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 transition-all">
                    Filtrar
                </button>
                <a href="{{ route('admin.users.index') }}"
                   class="py-2.5 px-4 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    {{-- TABLA --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <p class="text-sm font-semibold text-gray-700">Mostrando {{ $users->count() }} de {{ $users->total() }} usuarios</p>
>>>>>>> estetica
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3 text-left">Usuario</th>
                        <th class="px-6 py-3 text-left">Correo</th>
                        <th class="px-6 py-3 text-left">Rol</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-left">Registro</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                        <tr class="hover:bg-orange-50/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                                        @if($user->id === auth()->id())
                                            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded-full">Tú</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @php $roleMap = ['admin' => 'bg-purple-50 text-purple-700', 'comerciante' => 'bg-amber-50 text-amber-700', 'usuario' => 'bg-gray-100 text-gray-600']; @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $roleMap[$user->role] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->status === 'activo')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>Activo
                                    </span>
                                @elseif ($user->role === 'repartidor')
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        Repartidor
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>Baneado
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-xs">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    @if($user->status === 'activo')
                                        <form method="POST" action="{{ route('admin.users.ban', $user) }}"
                                              onsubmit="return confirm('¿Banear a {{ $user->name }}?')">
                                            @csrf @method('PATCH')
                                            <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-yellow-50 text-yellow-700 hover:bg-yellow-100 border border-yellow-200 transition-colors">
                                                Banear
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.users.activate', $user) }}">
                                            @csrf @method('PATCH')
                                            <button class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 transition-colors">
                                                Reactivar
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('¿Eliminar a {{ $user->name }}? Esta acción no se puede deshacer.')">
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
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3 border-2 border-dashed border-gray-200">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <p class="font-semibold text-gray-800">Sin usuarios</p>
                                <p class="text-sm text-gray-400 mt-0.5">No se encontraron usuarios con esos filtros.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">{{ $users->links() }}</div>
        @endif
    </div>

</div>
@endsection
