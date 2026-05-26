<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Panel Admin') — LocalMarket 24hrs</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased" x-data="{ sidebarOpen: false }">

<div class="min-h-screen flex">

    {{-- SIDEBAR OVERLAY (mobile) --}}
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-20 md:hidden"></div>

    {{-- SIDEBAR --}}
    <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 flex flex-col transform transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:z-auto"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center shadow-lg shadow-orange-500/30 shrink-0">
                <span class="text-white font-black text-xl leading-none">L</span>
            </div>
            <div>
                <p class="text-white font-black text-base leading-none">LocalMarket</p>
                <p class="text-orange-400 text-[10px] font-semibold tracking-widest uppercase leading-none mt-0.5">Admin Panel</p>
            </div>
        </div>

        {{-- Admin badge --}}
        <div class="px-6 py-4 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-white text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                    <p class="text-orange-400 text-xs font-medium">Administrador</p>
                </div>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
            <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest px-4 mb-3">General</p>

            @php
                $linkBase   = 'flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200';
                $linkIdle   = 'text-slate-300 hover:text-white hover:bg-white/10';
                $linkActive = 'text-orange-400 bg-orange-500/20 border border-orange-500/20';
            @endphp

            <a href="{{ route('admin.dashboard') }}"
               class="{{ $linkBase }} {{ request()->routeIs('admin.dashboard') ? $linkActive : $linkIdle }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest px-4 pt-4 mb-3">Gestión</p>

            <a href="{{ route('admin.users.index') }}"
               class="{{ $linkBase }} {{ request()->routeIs('admin.users.*') ? $linkActive : $linkIdle }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Usuarios
            </a>

            <a href="{{ route('admin.commerces.index') }}"
               class="{{ $linkBase }} {{ request()->routeIs('admin.commerces.*') ? $linkActive : $linkIdle }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Comercios
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="{{ $linkBase }} {{ request()->routeIs('admin.categories.*') ? $linkActive : $linkIdle }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Categorías
            </a>

            <a href="{{ route('admin.reports.index') }}"
               class="{{ $linkBase }} {{ request()->routeIs('admin.reports.*') ? $linkActive : $linkIdle }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Reportes
            </a>

            <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest px-4 pt-4 mb-3">Configuración</p>

            <a href="{{ route('admin.admin-users.create') }}"
               class="{{ $linkBase }} {{ request()->routeIs('admin.admin-users.*') ? $linkActive : $linkIdle }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Crear administrador
            </a>
        </nav>

        {{-- Logout --}}
        <div class="px-4 py-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl text-sm font-medium text-red-400 hover:text-white hover:bg-red-500/20 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- TOPBAR --}}
        <header class="sticky top-0 z-10 glass border-b border-white/60 shadow-sm">
            <div class="px-4 sm:px-6 py-4 flex items-center justify-between gap-4">

                {{-- Mobile menu toggle --}}
                <button @click="sidebarOpen = true"
                        class="md:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                {{-- Title / Breadcrumb --}}
                <div class="flex-1 min-w-0">
                    <h2 class="text-base font-bold text-gray-900 truncate">@yield('title', 'Panel Administrativo')</h2>
                    <p class="text-xs text-gray-400 hidden sm:block">LocalMarket 24hrs · Panel de administración</p>
                </div>

                {{-- Right actions --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('marketplace.home') }}"
                       class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 border border-gray-200 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Ver marketplace
                    </a>

                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden sm:block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6">

            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3.5 rounded-2xl text-sm font-medium">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-2xl text-sm font-medium">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>

    </div>
</div>

</body>
</html>
