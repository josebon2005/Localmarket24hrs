<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repartidores - LocalMarket 24hrs</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass { background: rgba(255,255,255,.85); backdrop-filter: blur(14px); }
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity .5s cubic-bezier(.22,1,.36,1), transform .5s cubic-bezier(.22,1,.36,1); }
        .reveal.visible { opacity: 1; transform: none; }
        .stagger-1 { transition-delay: .05s; }
        .stagger-2 { transition-delay: .10s; }
        .stagger-3 { transition-delay: .15s; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

{{-- ════════════════════ NAVBAR ════════════════════ --}}
<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
     :class="scrolled ? 'shadow-md' : 'shadow-sm'"
     class="sticky top-0 z-50 glass border-b border-white/60 transition-shadow duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <div class="flex items-center gap-3">
                <a href="{{ route('marketplace.home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center shadow-lg shadow-orange-500/30 group-hover:scale-105 transition-transform">
                        <span class="text-white font-black text-lg leading-none">L</span>
                    </div>
                    <div class="hidden sm:block">
                        <span class="font-black text-gray-900 text-lg leading-none">LocalMarket</span>
                        <span class="block text-[10px] font-semibold text-orange-500 leading-none tracking-widest uppercase">24hrs</span>
                    </div>
                </a>
                <div class="hidden md:flex items-center gap-1 ml-2 text-sm text-gray-400">
                    <span>/</span>
                    <a href="{{ route('comerciante.dashboard') }}" class="hover:text-gray-700 ml-1 transition-colors">Panel</a>
                    <span class="ml-1">/</span>
                    <span class="text-gray-600 font-medium ml-1">Repartidores</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('comerciante.dashboard') }}"
                   class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Panel
                </a>
                <a href="{{ route('comerciante.orders.index') }}"
                   class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Pedidos
                </a>
                <a href="{{ route('comerciante.conversations.index') }}"
                   class="relative p-2.5 rounded-xl text-gray-500 hover:text-orange-500 hover:bg-orange-50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    @if(!empty($unreadMerchantChats) && $unreadMerchantChats > 0)
                        <span class="absolute -top-1.5 -right-1.5 flex">
                            <span class="animate-ping absolute inline-flex h-3.5 w-3.5 rounded-full bg-orange-400 opacity-75"></span>
                            <span class="relative min-w-[14px] h-3.5 px-0.5 rounded-full bg-orange-500 text-white text-[9px] font-bold flex items-center justify-center leading-none ring-2 ring-white">{{ $unreadMerchantChats > 9 ? '9+' : $unreadMerchantChats }}</span>
                        </span>
                    @endif
                </a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-gray-100 transition-all">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                         class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                        <div class="px-4 py-2 border-b border-gray-100 mb-1">
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('comerciante.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Panel
                        </a>
                        <a href="{{ route('marketplace.commerces.show', $commerce) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Ver mi tienda
                        </a>
                        <div class="border-t border-gray-100 mt-1 pt-1">
                            <form method="POST" action="{{ route('logout') }}">@csrf
                                <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <button @click="open = !open" class="md:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden':open,'inline-flex':!open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden':!open,'inline-flex':open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    <div :class="{'block':open,'hidden':!open}" class="hidden md:hidden border-t border-gray-100 bg-white px-4 py-3 space-y-1.5">
        <a href="{{ route('comerciante.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">Panel</a>
        <a href="{{ route('comerciante.products.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">Productos</a>
        <a href="{{ route('comerciante.orders.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">Pedidos</a>
        <form method="POST" action="{{ route('logout') }}">@csrf
            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-red-600 hover:bg-red-50">Cerrar sesión</button>
        </form>
    </div>
</nav>

{{-- ════════════════════ HERO ════════════════════ --}}
@php
    $totalRepartidores  = $repartidores->count();
    $activeRepartidores = $repartidores->where('status', 'activo')->count();
    $inactiveRepartidores = $repartidores->where('status', 'inactivo')->count();
    $totalDeliveries    = $repartidores->sum('total_entregas');
@endphp

<section class="bg-gradient-to-br from-slate-900 via-slate-800 to-gray-900 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-amber-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(circle,#fff 1.5px,transparent 1.5px);background-size:28px 28px"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/10 backdrop-blur rounded-full border border-white/20 text-xs font-semibold text-orange-300 mb-4">
                <span class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-pulse"></span>
                {{ $commerce->name }} · LocalMarket 24hrs
            </div>
            <h1 class="text-3xl sm:text-4xl font-black leading-tight">
                Equipo de <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-400">repartidores</span>
            </h1>
            <p class="text-slate-400 mt-2 text-sm">Registra y gestiona el equipo de entrega de tu comercio.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-white/10 backdrop-blur rounded-2xl px-4 py-3.5 border border-white/10">
                <p class="text-2xl font-black text-white">{{ $totalRepartidores }}</p>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Total</p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl px-4 py-3.5 border border-white/10">
                <p class="text-2xl font-black text-green-400">{{ $activeRepartidores }}</p>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Activos</p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl px-4 py-3.5 border border-white/10">
                <p class="text-2xl font-black {{ $inactiveRepartidores > 0 ? 'text-red-400' : 'text-slate-400' }}">{{ $inactiveRepartidores }}</p>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Inactivos</p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl px-4 py-3.5 border border-white/10">
                <p class="text-2xl font-black text-orange-400">{{ $totalDeliveries }}</p>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Entregas totales</p>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 36L60 30.8C120 25.6 240 15.2 360 12C480 8.8 600 11.2 720 14.8C840 18.4 960 23.6 1080 24.4C1200 25.2 1320 21.6 1380 19.8L1440 18V36H0Z" fill="rgb(249,250,251)"/>
        </svg>
    </div>
</section>

{{-- ════════════════════ ALERTS ════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
    @if (session('success'))
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3.5 rounded-2xl text-sm font-medium mb-0">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-2xl text-sm font-medium mb-0">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif
</div>

{{-- ════════════════════ CONTENT ════════════════════ --}}
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-16">
    <div class="grid lg:grid-cols-5 gap-8 items-start">

        {{-- ── LISTA ── --}}
        <div class="lg:col-span-3 space-y-3">

            @forelse ($repartidores as $repartidor)
                <div class="reveal bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group hover:border-orange-200 hover:shadow-md transition-all duration-200">
                    <div class="p-5 flex items-center gap-4">

                        {{-- Avatar --}}
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 flex items-center justify-center text-white font-black text-lg shrink-0 shadow-md shadow-orange-500/20">
                            {{ strtoupper(substr($repartidor->name, 0, 1)) }}
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="font-bold text-gray-900">{{ $repartidor->name }}</h3>

                                @if ($repartidor->status === 'activo')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-bold bg-green-50 border border-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-bold bg-gray-50 border border-gray-200 text-gray-500">
                                        <span class="w-1.5 h-1.5 bg-gray-300 rounded-full"></span>Inactivo
                                    </span>
                                @endif

                                @if ($repartidor->entregas_activas > 0)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-bold bg-blue-50 border border-blue-100 text-blue-700">
                                        <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span>
                                        {{ $repartidor->entregas_activas }} en curso
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-400 mt-0.5 truncate">{{ $repartidor->email }}</p>
                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                {{ $repartidor->total_entregas }} {{ $repartidor->total_entregas === 1 ? 'entrega realizada' : 'entregas realizadas' }}
                            </p>
                        </div>

                        {{-- Acciones --}}
                        <div class="flex items-center gap-2 shrink-0">
                            <form method="POST" action="{{ route('comerciante.repartidores.toggle-status', $repartidor) }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        title="{{ $repartidor->status === 'activo' ? 'Desactivar' : 'Activar' }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold transition-all duration-200
                                        {{ $repartidor->status === 'activo'
                                            ? 'text-yellow-700 bg-yellow-50 border border-yellow-100 hover:bg-yellow-100'
                                            : 'text-green-700 bg-green-50 border border-green-100 hover:bg-green-100' }}">
                                    @if ($repartidor->status === 'activo')
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="hidden sm:inline">Desactivar</span>
                                    @else
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span class="hidden sm:inline">Activar</span>
                                    @endif
                                </button>
                            </form>

                            <form method="POST" action="{{ route('comerciante.repartidores.destroy', $repartidor) }}"
                                  x-data
                                  @submit.prevent="if(confirm('¿Eliminar a {{ addslashes($repartidor->name) }}? Sus pedidos asignados quedarán sin repartidor.')) $el.submit()">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        title="Eliminar"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-red-700 bg-red-50 border border-red-100 hover:bg-red-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    <span class="hidden sm:inline">Eliminar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="reveal bg-white rounded-3xl border border-gray-100 shadow-sm py-16 text-center">
                    <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-100 to-blue-50 flex items-center justify-center mx-auto mb-5 border-2 border-dashed border-indigo-200">
                        <svg class="w-9 h-9 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">Sin repartidores aún</h3>
                    <p class="text-gray-400 text-sm max-w-xs mx-auto">Registra el primer repartidor de tu equipo usando el formulario.</p>
                </div>
            @endforelse
        </div>

        {{-- ── FORMULARIO LATERAL ── --}}
        <div class="lg:col-span-2">
            <div class="sticky top-24 space-y-5">

                {{-- Formulario --}}
                <div class="reveal stagger-1 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-100 to-amber-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        </div>
                        <div>
                            <h2 class="font-black text-gray-900 text-sm">Registrar repartidor</h2>
                            <p class="text-xs text-gray-400">Crea una cuenta nueva para el equipo</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('comerciante.repartidores.store') }}" class="p-6 space-y-4">
                        @csrf

                        @if ($errors->any())
                            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-red-50 border border-red-200">
                                <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <ul class="text-xs text-red-600 space-y-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li>· {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Nombre --}}
                        <div>
                            <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                                Nombre completo <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                       placeholder="Nombre del repartidor"
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 {{ $errors->has('name') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 placeholder-gray-300 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                                Correo electrónico <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                       placeholder="correo@ejemplo.com"
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 {{ $errors->has('email') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 placeholder-gray-300 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                            </div>
                        </div>

                        {{-- Contraseña --}}
                        <div>
                            <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                                Contraseña <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                                <input type="password" id="password" name="password"
                                       placeholder="Mínimo 8 caracteres"
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 {{ $errors->has('password') ? 'border-red-300 bg-red-50' : 'border-gray-200 focus:border-orange-500' }} text-gray-900 placeholder-gray-300 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                            </div>
                        </div>

                        {{-- Confirmar contraseña --}}
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">
                                Confirmar contraseña <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       placeholder="Repite la contraseña"
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 border-gray-200 focus:border-orange-500 text-gray-900 placeholder-gray-300 text-sm transition-all focus:ring-4 focus:ring-orange-500/10 focus:outline-none">
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 hover:-translate-y-0.5 active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-orange-500/30 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Registrar repartidor
                        </button>
                    </form>
                </div>

                {{-- Info card --}}
                <div class="reveal stagger-2 bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-6 text-white">
                    <h3 class="font-bold text-sm mb-4 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-lg bg-orange-500/20 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        ¿Cómo funciona?
                    </h3>
                    <ul class="space-y-3">
                        @foreach ([
                            'El repartidor recibe sus credenciales y puede acceder con ellas.',
                            'Puedes desactivar temporalmente a un repartidor sin eliminarlo.',
                            'Al eliminar un repartidor, sus pedidos asignados quedan sin asignar.',
                            'Solo los repartidores activos pueden recibir nuevas asignaciones.',
                        ] as $item)
                            <li class="flex items-start gap-2.5 text-sm text-slate-300">
                                <svg class="w-4 h-4 text-orange-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</main>

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
        });
    }, { threshold: 0.06 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
