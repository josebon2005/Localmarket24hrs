@extends('admin.layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 text-white">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/2 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl sm:text-2xl font-black">Reportes de la plataforma</h1>
                    <p class="text-orange-100 text-sm mt-0.5">Resumen general de usuarios, categorías y comercios</p>
                </div>
            </div>
            <span class="shrink-0 px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold">
                {{ now()->format('d/m/Y') }}
            </span>
        </div>
    </div>

    {{-- USUARIOS --}}
    <div class="reveal">
        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Usuarios</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalUsers }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Total usuarios</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalMerchants }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Comerciantes</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalNormalUsers }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Compradores</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                    @if($totalBannedUsers > 0)
                        <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded-full">Alerta</span>
                    @endif
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalBannedUsers }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Baneados</p>
            </div>
        </div>
    </div>

    {{-- CATEGORÍAS --}}
    <div class="reveal">
        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Categorías</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalCategories }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Total categorías</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalActiveCategories }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Activas</p>
                @if($totalCategories > 0)
                    <div class="mt-3 h-1.5 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full rounded-full bg-green-400" style="width: {{ round($totalActiveCategories / $totalCategories * 100) }}%"></div>
                    </div>
                @endif
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalInactiveCategories }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Inactivas</p>
            </div>
        </div>
    </div>

    {{-- COMERCIOS --}}
    <div class="reveal">
        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 px-1">Comercios</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalCommerces }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Total comercios</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalActiveCommerces }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Activos</p>
                @if($totalCommerces > 0)
                    <div class="mt-3 h-1.5 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-full rounded-full bg-green-400" style="width: {{ round($totalActiveCommerces / $totalCommerces * 100) }}%"></div>
                    </div>
                @endif
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-yellow-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalSuspendedCommerces }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Suspendidos</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-gray-900">{{ $totalInactiveCommerces }}</p>
                <p class="text-xs font-semibold text-gray-500 mt-0.5">Inactivos</p>
            </div>
        </div>
    </div>

    {{-- LISTAS RECIENTES --}}
    <div class="reveal grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Usuarios recientes --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-800">Usuarios recientes</h3>
                <a href="{{ route('admin.users.index') }}" class="text-xs text-orange-500 hover:text-orange-600 font-semibold">Ver todos →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentUsers as $user)
                    <div class="px-5 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-bold text-xs shrink-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                        </div>
                        @php $roleMap = ['admin' => 'bg-purple-50 text-purple-700', 'comerciante' => 'bg-amber-50 text-amber-700', 'usuario' => 'bg-gray-100 text-gray-600']; @endphp
                        <span class="ml-auto shrink-0 px-2 py-0.5 rounded-full text-xs font-semibold {{ $roleMap[$user->role] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-center text-gray-400">Sin usuarios recientes</p>
                @endforelse
            </div>
        </div>

        {{-- Categorías recientes --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-800">Categorías recientes</h3>
                <a href="{{ route('admin.categories.index') }}" class="text-xs text-orange-500 hover:text-orange-600 font-semibold">Ver todas →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentCategories as $category)
                    <div class="px-5 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-bold text-xs shrink-0">
                            {{ strtoupper(substr($category->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $category->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $category->description ?? 'Sin descripción' }}</p>
                        </div>
                        <span class="shrink-0 inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold {{ $category->status === 'activa' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $category->status === 'activa' ? 'bg-green-400' : 'bg-gray-400' }}"></span>
                            {{ ucfirst($category->status) }}
                        </span>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-center text-gray-400">Sin categorías recientes</p>
                @endforelse
            </div>
        </div>

        {{-- Comercios recientes --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-800">Comercios recientes</h3>
                <a href="{{ route('admin.commerces.index') }}" class="text-xs text-orange-500 hover:text-orange-600 font-semibold">Ver todos →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentCommerces as $commerce)
                    <div class="px-5 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-bold text-xs shrink-0">
                            {{ strtoupper(substr($commerce->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $commerce->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $commerce->user->name ?? 'Sin dueño' }}</p>
                        </div>
                        @php $sMap = ['activo' => 'bg-green-50 text-green-700', 'suspendido' => 'bg-yellow-50 text-yellow-700', 'inactivo' => 'bg-gray-100 text-gray-500']; @endphp
                        <span class="shrink-0 px-2 py-0.5 rounded-full text-xs font-semibold {{ $sMap[$commerce->status] ?? 'bg-gray-100 text-gray-500' }}">
                            {{ ucfirst($commerce->status) }}
                        </span>
                    </div>
                @empty
                    <p class="px-5 py-6 text-sm text-center text-gray-400">Sin comercios recientes</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
