<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel - LocalMarket 24hrs</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .float-a { animation: floatA 5s ease-in-out infinite; }
        .float-b { animation: floatA 5s ease-in-out 1.5s infinite; }
        .float-c { animation: floatA 5s ease-in-out 3s infinite; }
        @keyframes floatA {
            0%,100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }
        .count-up { animation: countFade .7s ease-out both; }
        @keyframes countFade {
            from { opacity:0; transform:translateY(16px); }
            to   { opacity:1; transform:translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased overflow-x-hidden">

{{-- NAVBAR --}}
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
                    <span class="text-gray-600 font-medium ml-1">Panel del comerciante</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('marketplace.home') }}"
                   class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Marketplace
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
                        <a href="{{ route('marketplace.home') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Ver marketplace
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
        <a href="{{ route('marketplace.home') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">Ver marketplace</a>
        <a href="{{ route('comerciante.products.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">Mis productos</a>
        <a href="{{ route('comerciante.orders.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">Pedidos</a>
        <a href="{{ route('comerciante.conversations.index') }}" class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100">
            Chats
            @if(!empty($unreadMerchantChats) && $unreadMerchantChats > 0)
                <span class="ml-auto min-w-[18px] h-[18px] px-1 rounded-full bg-orange-500 text-white text-[10px] font-bold flex items-center justify-center leading-none">{{ $unreadMerchantChats > 9 ? '9+' : $unreadMerchantChats }}</span>
            @endif
        </a>
        <form method="POST" action="{{ route('logout') }}">@csrf
            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-red-600 hover:bg-red-50">Cerrar sesión</button>
        </form>
    </div>
</nav>

@if (session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3.5 rounded-2xl text-sm font-medium">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    </div>
@endif
@if (session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-2xl text-sm font-medium">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    </div>
@endif

@if (auth()->user()->commerce)
@php
    $commerce = auth()->user()->commerce;
    $totalProducts    = $commerce->products()->count();
    $activeProducts   = $commerce->products()->where('status','activo')->count();
    $lowStockProducts = $commerce->products()->where('stock','<=',5)->count();
    $totalInventory   = $commerce->products()->sum('stock');
    $receivedOrders   = \App\Models\Order::whereHas('items', fn($q) => $q->where('commerce_id', $commerce->id))->count();
    $pendingOrders    = \App\Models\Order::whereHas('items', fn($q) => $q->where('commerce_id', $commerce->id))->where('status','pendiente')->count();
    $totalSales       = \App\Models\OrderItem::where('commerce_id', $commerce->id)->sum('subtotal');
    $recentOrders     = \App\Models\Order::whereHas('items', fn($q) => $q->where('commerce_id', $commerce->id))
        ->with(['user', 'items' => fn($q) => $q->where('commerce_id', $commerce->id)->with('product')])
        ->latest()->take(5)->get();
    $statusConfig = [
        'pendiente'      => ['label'=>'Pendiente',      'color'=>'bg-yellow-50 text-yellow-700 border-yellow-200', 'dot'=>'bg-yellow-400'],
        'confirmado'     => ['label'=>'Confirmado',     'color'=>'bg-blue-50 text-blue-700 border-blue-200',       'dot'=>'bg-blue-400'],
        'en_preparacion' => ['label'=>'En preparación', 'color'=>'bg-indigo-50 text-indigo-700 border-indigo-200', 'dot'=>'bg-indigo-400'],
        'en_camino'      => ['label'=>'En camino',      'color'=>'bg-purple-50 text-purple-700 border-purple-200', 'dot'=>'bg-purple-400'],
        'entregado'      => ['label'=>'Entregado',      'color'=>'bg-green-50 text-green-700 border-green-200',    'dot'=>'bg-green-400'],
        'cancelado'      => ['label'=>'Cancelado',      'color'=>'bg-red-50 text-red-700 border-red-200',          'dot'=>'bg-red-400'],
    ];
@endphp

{{-- ══════ HERO ══════ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-gray-900 text-white">
    {{-- Decorative blobs --}}
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-amber-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(circle,#fff 1.5px,transparent 1.5px);background-size:28px 28px"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- Left: Welcome text --}}
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur rounded-full border border-white/20 text-sm font-semibold text-orange-300 mb-6">
                    <span class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></span>
                    Panel del comerciante · LocalMarket 24hrs
                </div>
                <h1 class="text-4xl sm:text-5xl font-black leading-tight mb-4">
                    Hola, <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-400">{{ auth()->user()->name }}</span>
                </h1>
                <p class="text-slate-400 text-lg leading-relaxed mb-8 max-w-md">
                    Gestiona tu comercio, revisa pedidos y mantén tu tienda siempre actualizada desde un solo lugar.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('comerciante.products.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-400 hover:to-orange-500 shadow-xl shadow-orange-500/30 hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Nuevo producto
                    </a>
                    <a href="{{ route('marketplace.commerces.show', $commerce) }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Ver mi tienda
                    </a>
                </div>
            </div>

            {{-- Right: Floating mini-cards --}}
            <div class="hidden lg:block relative h-64">
                {{-- Commerce card --}}
                <div class="float-a absolute top-0 left-1/2 -translate-x-1/2 bg-white rounded-2xl shadow-2xl border border-gray-100 p-5 w-56">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-black text-lg shadow">
                            {{ strtoupper(substr($commerce->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-black text-gray-900 truncate">{{ $commerce->name }}</p>
                            <p class="text-[10px] text-gray-400">{{ $commerce->category->name ?? 'Sin categoría' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between bg-green-50 rounded-xl px-3 py-2">
                        <span class="text-xs font-semibold text-green-700">Ventas totales</span>
                        <span class="text-sm font-black text-green-700">Q{{ number_format($totalSales, 0) }}</span>
                    </div>
                </div>

                {{-- Pending orders chip --}}
                <div class="float-b absolute top-4 right-0 bg-white rounded-2xl shadow-xl border border-gray-100 p-4 w-44">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-7 h-7 rounded-lg bg-yellow-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-800">Pendientes</p>
                    </div>
                    <p class="text-3xl font-black text-gray-900">{{ $pendingOrders }}</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">pedidos por atender</p>
                </div>

                {{-- Products chip --}}
                <div class="float-c absolute bottom-0 left-4 bg-white rounded-2xl shadow-xl border border-gray-100 px-4 py-3 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-orange-500 flex items-center justify-center shadow">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-black text-gray-900 leading-none">{{ $activeProducts }}</p>
                        <p class="text-[10px] text-gray-400 leading-none mt-0.5">productos activos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Wave --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 48L60 41.2C120 34.4 240 20.8 360 16C480 11.2 600 14.4 720 19.6C840 24.8 960 31.2 1080 32.4C1200 33.6 1320 29.6 1380 27.6L1440 25.6V48H1380C1320 48 1200 48 1080 48C960 48 840 48 720 48C600 48 480 48 360 48C240 48 120 48 60 48H0Z" fill="rgb(249,250,251)"/>
        </svg>
    </div>
</section>

{{-- ══════ STATS BAR ══════ --}}
<section class="bg-gray-50 pb-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 -mt-2 pb-10">
            <div class="reveal count-up bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <p class="text-3xl font-black text-green-500 mb-1">Q{{ number_format($totalSales, 0) }}</p>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Ventas totales</p>
            </div>
            <div class="reveal stagger-2 count-up bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <p class="text-3xl font-black text-blue-500 mb-1">{{ $receivedOrders }}</p>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Pedidos recibidos</p>
            </div>
            <div class="reveal stagger-3 count-up bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <p class="text-3xl font-black text-orange-500 mb-1">{{ $totalProducts }}</p>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Productos</p>
            </div>
            <div class="reveal stagger-4 count-up bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md hover:-translate-y-1 transition-all duration-300 {{ $lowStockProducts > 0 ? 'border-red-200' : '' }}">
                <p class="text-3xl font-black mb-1 {{ $lowStockProducts > 0 ? 'text-red-500' : 'text-gray-900' }}">{{ $lowStockProducts }}</p>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Bajo stock</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════ QUICK ACTIONS ══════ --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <span class="inline-block px-4 py-1.5 rounded-full bg-orange-100 text-orange-700 text-xs font-bold uppercase tracking-widest mb-4">Gestión</span>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mb-3">Administra tu comercio</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Accede rápidamente a todo lo que necesitas para mantener tu tienda al día.</p>
        </div>

        @php
            $actions = [
                ['href'=> route('comerciante.products.index'),     'emoji'=>'📦', 'title'=>'Mis productos',    'desc'=>'Visualiza y edita todos los productos de tu tienda.',          'color'=>'orange', 'badge'=>null],
                ['href'=> route('comerciante.products.create'),    'emoji'=>'➕', 'title'=>'Nuevo producto',   'desc'=>'Añade un producto nuevo a tu catálogo en segundos.',           'color'=>'amber',  'badge'=>null],
                ['href'=> route('comerciante.orders.index'),       'emoji'=>'🧾', 'title'=>'Pedidos',           'desc'=>'Revisa y gestiona los pedidos que han hecho tus clientes.',   'color'=>'blue',   'badge'=>$pendingOrders > 0 ? $pendingOrders : null],
                ['href'=> route('comerciante.coupons.index'),      'emoji'=>'🏷️', 'title'=>'Cupones',           'desc'=>'Crea descuentos y promociones para atraer más clientes.',     'color'=>'green',  'badge'=>null],
                ['href'=> route('comerciante.conversations.index'),'emoji'=>'💬', 'title'=>'Chats',             'desc'=>'Atiende los mensajes y consultas de tus clientes.',           'color'=>'purple', 'badge'=>(!empty($unreadMerchantChats) && $unreadMerchantChats > 0) ? $unreadMerchantChats : null],
                ['href'=> route('marketplace.commerces.show', $commerce), 'emoji'=>'👁️', 'title'=>'Ver mi tienda',  'desc'=>'Mira cómo ven tu comercio los compradores del marketplace.', 'color'=>'slate',  'badge'=>null],
                ['href'=> route('comerciante.commerce.edit'),      'emoji'=>'✏️', 'title'=>'Editar tienda',    'desc'=>'Actualiza nombre, teléfono, dirección, logo y banner.',        'color'=>'teal',   'badge'=>null],
                ['href'=> route('comerciante.repartidores.index'), 'emoji'=>'🛵', 'title'=>'Repartidores',      'desc'=>'Registra y gestiona el equipo de entrega de tu comercio.',    'color'=>'indigo', 'badge'=>null],
            ];
            $cMap = [
                'orange' => ['icon'=>'bg-orange-50',  'iconH'=>'group-hover:bg-orange-100', 'border'=>'hover:border-orange-200', 'card'=>'hover:bg-orange-50/40',  'text'=>'group-hover:text-orange-600'],
                'amber'  => ['icon'=>'bg-amber-50',   'iconH'=>'group-hover:bg-amber-100',  'border'=>'hover:border-amber-200',  'card'=>'hover:bg-amber-50/40',   'text'=>'group-hover:text-amber-600'],
                'blue'   => ['icon'=>'bg-blue-50',    'iconH'=>'group-hover:bg-blue-100',   'border'=>'hover:border-blue-200',   'card'=>'hover:bg-blue-50/40',    'text'=>'group-hover:text-blue-600'],
                'green'  => ['icon'=>'bg-green-50',   'iconH'=>'group-hover:bg-green-100',  'border'=>'hover:border-green-200',  'card'=>'hover:bg-green-50/40',   'text'=>'group-hover:text-green-600'],
                'purple' => ['icon'=>'bg-purple-50',  'iconH'=>'group-hover:bg-purple-100', 'border'=>'hover:border-purple-200', 'card'=>'hover:bg-purple-50/40',  'text'=>'group-hover:text-purple-600'],
                'slate'  => ['icon'=>'bg-slate-50',   'iconH'=>'group-hover:bg-slate-100',  'border'=>'hover:border-slate-200',  'card'=>'hover:bg-slate-50/40',   'text'=>'group-hover:text-slate-600'],
                'teal'   => ['icon'=>'bg-teal-50',    'iconH'=>'group-hover:bg-teal-100',   'border'=>'hover:border-teal-200',   'card'=>'hover:bg-teal-50/40',    'text'=>'group-hover:text-teal-600'],
                'indigo' => ['icon'=>'bg-indigo-50',  'iconH'=>'group-hover:bg-indigo-100', 'border'=>'hover:border-indigo-200', 'card'=>'hover:bg-indigo-50/40',  'text'=>'group-hover:text-indigo-600'],
            ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($actions as $action)
                @php $stagger = ($loop->index % 3) + 1; $c = $cMap[$action['color']]; @endphp
                <a href="{{ $action['href'] }}"
                   class="reveal stagger-{{ $stagger }} group relative bg-white rounded-3xl p-7 border-2 border-gray-100 {{ $c['border'] }} {{ $c['card'] }} hover:-translate-y-1.5 hover:shadow-xl transition-all duration-300">
                    @if($action['badge'])
                        <span class="absolute top-5 right-5 min-w-[24px] h-6 px-1.5 rounded-full bg-orange-500 text-white text-xs font-bold flex items-center justify-center leading-none shadow">
                            {{ $action['badge'] > 9 ? '9+' : $action['badge'] }}
                        </span>
                    @endif
                    <div class="w-16 h-16 {{ $c['icon'] }} {{ $c['iconH'] }} rounded-2xl flex items-center justify-center text-3xl mb-5 group-hover:scale-110 transition-all duration-300">
                        {{ $action['emoji'] }}
                    </div>
                    <h3 class="font-black text-gray-900 text-lg mb-2 {{ $c['text'] }} transition-colors">{{ $action['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $action['desc'] }}</p>
                    <div class="flex items-center gap-1.5 mt-5 text-xs font-semibold {{ $c['text'] }} transition-colors opacity-0 group-hover:opacity-100 translate-y-1 group-hover:translate-y-0 transition-all duration-300">
                        Ir ahora
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════ RECENT ORDERS (dark) ══════ --}}
<section class="bg-slate-900 relative overflow-hidden py-16">
    <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:28px 28px"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10 reveal">
            <div>
                <span class="inline-block px-4 py-1.5 rounded-full bg-orange-500/20 text-orange-400 text-xs font-bold uppercase tracking-widest mb-4">Actividad reciente</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white">Últimos pedidos</h2>
                <p class="text-slate-400 mt-1">Los 5 pedidos más recientes de tu comercio.</p>
            </div>
            <a href="{{ route('comerciante.orders.index') }}"
               class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 transition-all">
                Ver todos →
            </a>
        </div>

        @if ($recentOrders->count() > 0)
            <div class="space-y-3">
                @foreach ($recentOrders as $order)
                    @php
                        $commerceSubtotal = $order->items->sum('subtotal');
                        $sc = $statusConfig[$order->status] ?? ['label'=>ucfirst($order->status),'color'=>'bg-gray-50 text-gray-600 border-gray-200','dot'=>'bg-gray-400'];
                        $stagger = $loop->index + 1;
                    @endphp
                    <a href="{{ route('comerciante.orders.show', $order) }}"
                       class="reveal stagger-{{ min($stagger,4) }} group flex items-center gap-4 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/20 rounded-2xl px-5 py-4 transition-all duration-200">
                        <div class="w-11 h-11 rounded-xl bg-white/10 group-hover:bg-orange-500/20 flex items-center justify-center shrink-0 transition-colors">
                            <span class="text-white font-black text-sm">#{{ $order->id }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-white truncate">{{ $order->user->name ?? 'Sin comprador' }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold border shrink-0 {{ $sc['color'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }}"></span>
                            {{ $sc['label'] }}
                        </span>
                        <p class="font-black text-white shrink-0 hidden sm:block text-base">Q{{ number_format($commerceSubtotal, 2) }}</p>
                        <svg class="w-5 h-5 text-slate-600 group-hover:text-orange-400 group-hover:translate-x-1 transition-all shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endforeach
            </div>
            <div class="sm:hidden mt-6 text-center">
                <a href="{{ route('comerciante.orders.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl text-sm font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/20 transition-all">
                    Ver todos los pedidos →
                </a>
            </div>
        @else
            <div class="reveal text-center py-14 bg-white/5 rounded-3xl border border-white/10">
                <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <p class="font-bold text-white mb-1">Aún no tienes pedidos</p>
                <p class="text-sm text-slate-400">Cuando alguien compre tus productos aparecerán aquí.</p>
            </div>
        @endif
    </div>
</section>

{{-- ══════ COMMERCE INFO FOOTER ══════ --}}
<section class="py-12 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="reveal grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="flex items-center gap-4 p-5 rounded-2xl bg-gray-50 border border-gray-100">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Teléfono</p>
                    <p class="font-bold text-gray-900 mt-0.5">{{ $commerce->phone ?: 'No registrado' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-5 rounded-2xl bg-gray-50 border border-gray-100">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Dirección</p>
                    <p class="font-bold text-gray-900 mt-0.5">{{ $commerce->address ?: 'No registrada' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-5 rounded-2xl bg-gray-50 border border-gray-100">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Categoría</p>
                    <p class="font-bold text-gray-900 mt-0.5">{{ $commerce->category->name ?? 'Sin categoría' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@else
{{-- ══════ NO COMMERCE ══════ --}}
<section class="relative overflow-hidden min-h-[80vh] flex items-center bg-gradient-to-br from-orange-50 via-amber-50/30 to-white">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-orange-100/40 rounded-full blur-3xl -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
    <div class="relative max-w-2xl mx-auto px-4 sm:px-6 py-20 text-center">
        <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-orange-100 to-amber-50 flex items-center justify-center mx-auto mb-8 border-2 border-dashed border-orange-200 shadow-inner">
            <svg class="w-10 h-10 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <span class="inline-block px-4 py-1.5 rounded-full bg-orange-100 text-orange-700 text-xs font-bold uppercase tracking-widest mb-6">Bienvenido</span>
        <h2 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4">Crea tu comercio</h2>
        <p class="text-gray-500 text-lg leading-relaxed mb-10 max-w-md mx-auto">
            Registra tu negocio, sube tus productos y empieza a recibir pedidos de clientes locales hoy mismo.
        </p>
        <a href="{{ route('comerciante.commerce.create') }}"
           class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl text-base font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-xl shadow-orange-500/30 hover:-translate-y-0.5 transition-all duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Crear mi comercio gratis
        </a>
    </div>
</section>
@endif

</body>
</html>
