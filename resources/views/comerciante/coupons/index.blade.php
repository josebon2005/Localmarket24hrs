<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cupones - LocalMarket 24hrs</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass { background: rgba(255,255,255,.85); backdrop-filter: blur(14px); }
        .reveal { opacity: 0; transform: translateY(20px); transition: opacity .5s cubic-bezier(.22,1,.36,1), transform .5s cubic-bezier(.22,1,.36,1); }
        .reveal.visible { opacity: 1; transform: none; }
        .row-hover { transition: background .15s; }
        .row-hover:hover { background: rgb(255 247 237); }
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
                    <span class="text-gray-600 font-medium ml-1">Cupones</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('comerciante.dashboard') }}"
                   class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Panel
                </a>
                <a href="{{ route('comerciante.products.index') }}"
                   class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    Productos
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
        <a href="{{ route('comerciante.coupons.create') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-orange-600 bg-orange-50">+ Nuevo cupón</a>
        <a href="{{ route('comerciante.products.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">Productos</a>
        <a href="{{ route('comerciante.orders.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">Pedidos</a>
        <form method="POST" action="{{ route('logout') }}">@csrf
            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-red-600 hover:bg-red-50">Cerrar sesión</button>
        </form>
    </div>
</nav>

{{-- ════════════════════ HERO ════════════════════ --}}
@php
    $totalCoupons  = $commerce->coupons()->count();
    $activeCoupons = $commerce->coupons()->where('status', 'activo')->count();
    $totalUses     = $commerce->coupons()->sum('used_count');
    $expiredCount  = $commerce->coupons()->where('status', 'activo')->whereNotNull('expires_at')->where('expires_at', '<', now())->count();
@endphp

<section class="bg-gradient-to-br from-slate-900 via-slate-800 to-gray-900 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-amber-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(circle,#fff 1.5px,transparent 1.5px);background-size:28px 28px"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/10 backdrop-blur rounded-full border border-white/20 text-xs font-semibold text-orange-300 mb-4">
                    <span class="w-1.5 h-1.5 bg-orange-400 rounded-full animate-pulse"></span>
                    {{ $commerce->name }} · LocalMarket 24hrs
                </div>
                <h1 class="text-3xl sm:text-4xl font-black leading-tight">
                    Mis <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-400">cupones</span>
                </h1>
                <p class="text-slate-400 mt-2 text-sm">Crea descuentos y promociones para atraer más clientes.</p>
            </div>
            <a href="{{ route('comerciante.coupons.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 shadow-xl shadow-orange-500/30 hover:-translate-y-0.5 transition-all duration-200 self-start sm:self-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nuevo cupón
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-white/10 backdrop-blur rounded-2xl px-4 py-3.5 border border-white/10">
                <p class="text-2xl font-black text-white">{{ $totalCoupons }}</p>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Total</p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl px-4 py-3.5 border border-white/10">
                <p class="text-2xl font-black text-green-400">{{ $activeCoupons }}</p>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Activos</p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl px-4 py-3.5 border border-white/10">
                <p class="text-2xl font-black text-orange-400">{{ $totalUses }}</p>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Usos totales</p>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-2xl px-4 py-3.5 border border-white/10">
                <p class="text-2xl font-black {{ $expiredCount > 0 ? 'text-red-400' : 'text-slate-400' }}">{{ $expiredCount }}</p>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide mt-0.5">Vencidos</p>
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
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3.5 rounded-2xl text-sm font-medium mb-4">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-2xl text-sm font-medium mb-4">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif
</div>

{{-- ════════════════════ TABLE ════════════════════ --}}
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

    <div class="reveal bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

        @if ($coupons->count() > 0)

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/60">
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Código</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Descuento</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Uso</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Vigencia</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Estado</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($coupons as $coupon)
                            @php
                                $isExpired = $coupon->expires_at && $coupon->expires_at->isPast();
                                $isActive  = $coupon->status === 'activo' && !$isExpired;
                                $usageRatio = $coupon->usage_limit ? ($coupon->used_count / $coupon->usage_limit) : 0;
                            @endphp
                            <tr class="row-hover">
                                {{-- Código --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-green-100 to-emerald-50 border border-green-100 flex items-center justify-center shrink-0">
                                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                        </div>
                                        <div>
                                            <p class="font-black text-gray-900 tracking-wider">{{ $coupon->code }}</p>
                                            @if ($coupon->description)
                                                <p class="text-xs text-gray-400 mt-0.5">{{ $coupon->description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Descuento --}}
                                <td class="px-6 py-4">
                                    <p class="font-black text-gray-900 text-base">
                                        @if ($coupon->type === 'fixed')
                                            Q{{ number_format($coupon->value, 2) }}
                                        @else
                                            {{ number_format($coupon->value, 0) }}%
                                        @endif
                                    </p>
                                    @if ($coupon->minimum_total > 0)
                                        <p class="text-xs text-gray-400 mt-0.5">Mín. Q{{ number_format($coupon->minimum_total, 2) }}</p>
                                    @endif
                                </td>

                                {{-- Uso --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-800">{{ $coupon->used_count }}</span>
                                        <span class="text-gray-300">/</span>
                                        <span class="text-gray-500">{{ $coupon->usage_limit ?? '∞' }}</span>
                                    </div>
                                    @if ($coupon->usage_limit)
                                        <div class="mt-1.5 w-20 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full rounded-full {{ $usageRatio >= 1 ? 'bg-red-400' : ($usageRatio >= 0.7 ? 'bg-yellow-400' : 'bg-green-400') }}"
                                                 style="width: {{ min($usageRatio * 100, 100) }}%"></div>
                                        </div>
                                    @endif
                                </td>

                                {{-- Vigencia --}}
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-600">
                                        {{ $coupon->starts_at?->format('d/m/Y') ?? 'Hoy' }}
                                    </p>
                                    <p class="text-xs mt-0.5 {{ $isExpired ? 'text-red-500 font-semibold' : 'text-gray-400' }}">
                                        {{ $coupon->expires_at ? 'Vence: ' . $coupon->expires_at->format('d/m/Y') : 'Sin vencimiento' }}
                                    </p>
                                </td>

                                {{-- Estado --}}
                                <td class="px-6 py-4">
                                    @if ($isExpired)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-50 border border-red-100 text-red-600 text-xs font-bold rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                            Vencido
                                        </span>
                                    @elseif ($isActive)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-50 border border-green-100 text-green-700 text-xs font-bold rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                            Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-50 border border-gray-200 text-gray-500 text-xs font-bold rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                {{-- Acciones --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('comerciante.coupons.edit', $coupon) }}"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-100 hover:bg-blue-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Editar
                                        </a>
                                        <form method="POST" action="{{ route('comerciante.coupons.toggle-status', $coupon) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold transition-colors
                                                    {{ $coupon->status === 'activo'
                                                        ? 'text-yellow-700 bg-yellow-50 border border-yellow-100 hover:bg-yellow-100'
                                                        : 'text-green-700 bg-green-50 border border-green-100 hover:bg-green-100' }}">
                                                @if ($coupon->status === 'activo')
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    Desactivar
                                                @else
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    Activar
                                                @endif
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('comerciante.coupons.destroy', $coupon) }}"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar el cupón «{{ addslashes($coupon->code) }}»?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-red-700 bg-red-50 border border-red-100 hover:bg-red-100 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($coupons->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/40">
                    {{ $coupons->links() }}
                </div>
            @endif

        @else
            <div class="py-24 text-center">
                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-green-100 to-emerald-50 flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-green-200">
                    <svg class="w-9 h-9 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-2">Sin cupones aún</h3>
                <p class="text-gray-500 text-sm mb-8 max-w-xs mx-auto">Crea tu primer cupón para ofrecer descuentos y atraer más clientes.</p>
                <a href="{{ route('comerciante.coupons.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Crear primer cupón
                </a>
            </div>
        @endif
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
