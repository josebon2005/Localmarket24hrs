<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis pedidos - LocalMarket 24hrs</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

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
                    <span class="text-gray-600 font-medium ml-1">Mis pedidos</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('marketplace.home') }}"
                   class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Inicio
                </a>

                <a href="{{ route('marketplace.cart.index') }}"
                   class="relative p-2.5 rounded-xl text-gray-500 hover:text-orange-500 hover:bg-orange-50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </a>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-gray-100 transition-all">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                         class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                        <div class="px-4 py-2 border-b border-gray-100 mb-1">
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('marketplace.orders.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-orange-600 font-medium hover:bg-orange-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Mis pedidos
                        </a>
                        <a href="{{ route('marketplace.conversations.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Mis chats
                        </a>
                        <div class="border-t border-gray-100 mt-1 pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 text-white py-10 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3 text-orange-200 text-sm mb-4">
            <a href="{{ route('marketplace.home') }}" class="hover:text-white transition-colors">Inicio</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white font-medium">Mis pedidos</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-black">Mis pedidos</h1>
                <p class="text-orange-100 mt-0.5">Historial de todas tus compras</p>
            </div>
            @if($orders->total() > 0)
                <div class="ml-auto hidden sm:block">
                    <span class="px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold">
                        {{ $orders->total() }} {{ $orders->total() === 1 ? 'pedido' : 'pedidos' }}
                    </span>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- CONTENT --}}
<main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3.5 rounded-2xl text-sm font-medium">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                @php
                    $statusConfig = [
                        'pendiente'      => ['label' => 'Pendiente',      'color' => 'bg-yellow-50 text-yellow-700 border-yellow-200',  'dot' => 'bg-yellow-400'],
                        'confirmado'     => ['label' => 'Confirmado',     'color' => 'bg-blue-50 text-blue-700 border-blue-200',        'dot' => 'bg-blue-400'],
                        'en_preparacion' => ['label' => 'En preparación', 'color' => 'bg-indigo-50 text-indigo-700 border-indigo-200',  'dot' => 'bg-indigo-400'],
                        'en_camino'      => ['label' => 'En camino',      'color' => 'bg-purple-50 text-purple-700 border-purple-200',  'dot' => 'bg-purple-400'],
                        'entregado'      => ['label' => 'Entregado',      'color' => 'bg-green-50 text-green-700 border-green-200',     'dot' => 'bg-green-400'],
                        'cancelado'      => ['label' => 'Cancelado',      'color' => 'bg-red-50 text-red-700 border-red-200',           'dot' => 'bg-red-400'],
                    ];
                    $sc = $statusConfig[$order->status] ?? ['label' => $order->statusLabel(), 'color' => 'bg-gray-50 text-gray-700 border-gray-200', 'dot' => 'bg-gray-400'];
                @endphp

                <a href="{{ route('marketplace.orders.show', $order) }}"
                   class="reveal group flex flex-col sm:flex-row sm:items-center gap-4 bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md transition-all duration-200">

                    {{-- Order number + date --}}
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-50 to-amber-50 border border-orange-100 flex items-center justify-center shrink-0 group-hover:from-orange-100 group-hover:to-amber-100 transition-colors">
                            <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors">
                                Pedido #{{ $order->id }}
                            </p>
                            <p class="text-sm text-gray-400 mt-0.5">
                                {{ $order->created_at->format('d/m/Y') }} · {{ $order->created_at->diffForHumans() }}
                            </p>
                            @if($order->items->count() > 0)
                                <p class="text-xs text-gray-400 mt-0.5 truncate">
                                    {{ $order->items->first()->product->name ?? 'Producto' }}
                                    @if($order->items->count() > 1)
                                        y {{ $order->items->count() - 1 }} más
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Status + total --}}
                    <div class="flex items-center justify-between sm:justify-end gap-4 sm:gap-6">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold border {{ $sc['color'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }}"></span>
                            {{ $sc['label'] }}
                        </span>
                        <div class="text-right">
                            <p class="font-black text-gray-900 text-lg">Q{{ number_format($order->total, 2) }}</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-orange-400 group-hover:translate-x-1 transition-all shrink-0 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>

        @if($orders->hasPages())
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif

    @else
        {{-- Empty state --}}
        <div class="reveal text-center py-20">
            <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-orange-100 to-amber-50 flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-orange-200">
                <svg class="w-10 h-10 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h2 class="text-2xl font-black text-gray-900 mb-2">Aún no tienes pedidos</h2>
            <p class="text-gray-500 mb-8 max-w-sm mx-auto">
                Cuando confirmes una compra desde tu carrito, aparecerá aquí.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('marketplace.home') }}" class="btn-brand px-6 py-3 rounded-xl text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Explorar comercios
                </a>
                <a href="{{ route('marketplace.cart.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:border-orange-300 hover:text-orange-600 transition-all shadow-sm">
                    Ver mi carrito
                </a>
            </div>
        </div>
    @endif

</main>

</body>
</html>
