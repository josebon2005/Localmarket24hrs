@extends('admin.layouts.app')

@section('title', 'Reportes Administrativos')

@section('content')
    <div class="space-y-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">Reportes básicos</h1>
            <p class="text-gray-500 mt-1">
                Resumen general de usuarios, categorías y comercios registrados en la plataforma.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Total de usuarios</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios registrados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Administradores</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalAdmins }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios admin</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Compradores</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalNormalUsers }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios normales</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comerciantes</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalMerchants }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios comerciantes</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Usuarios baneados</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalBannedUsers }}</h3>
                <p class="text-xs text-gray-400 mt-2">Usuarios restringidos</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categorías</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCategories }}</h3>
                <p class="text-xs text-gray-400 mt-2">Total registradas</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categorías activas</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalActiveCategories }}</h3>
                <p class="text-xs text-gray-400 mt-2">Disponibles</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Categorías inactivas</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalInactiveCategories }}</h3>
                <p class="text-xs text-gray-400 mt-2">No disponibles</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Total registrados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios activos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalActiveCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Habilitados</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios suspendidos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalSuspendedCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">Restringidos</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <p class="text-sm text-gray-500">Comercios inactivos</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalInactiveCommerces }}</h3>
                <p class="text-xs text-gray-400 mt-2">No habilitados</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Usuarios recientes</h2>

                <div class="space-y-3">
                    @forelse ($recentUsers as $user)
                        <div class="border-b border-gray-100 pb-3 last:border-0">
                            <p class="font-medium text-gray-800">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            <p class="text-xs text-gray-400">
                                Rol: {{ ucfirst($user->role) }} | Estado: {{ ucfirst($user->status) }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No hay usuarios recientes.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Categorías recientes</h2>

                <div class="space-y-3">
                    @forelse ($recentCategories as $category)
                        <div class="border-b border-gray-100 pb-3 last:border-0">
                            <p class="font-medium text-gray-800">{{ $category->name }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $category->description ?? 'Sin descripción' }}
                            </p>
                            <p class="text-xs text-gray-400">
                                Estado: {{ ucfirst($category->status) }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No hay categorías recientes.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Comercios recientes</h2>

                <div class="space-y-3">
                    @forelse ($recentCommerces as $commerce)
                        <div class="border-b border-gray-100 pb-3 last:border-0">
                            <p class="font-medium text-gray-800">{{ $commerce->name }}</p>
                            <p class="text-sm text-gray-500">
                                Dueño: {{ $commerce->user->name ?? 'Sin dueño' }}
                            </p>
                            <p class="text-xs text-gray-400">
                                Categoría: {{ $commerce->category->name ?? 'Sin categoría' }} |
                                Estado: {{ ucfirst($commerce->status) }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No hay comercios recientes.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
@endsection
