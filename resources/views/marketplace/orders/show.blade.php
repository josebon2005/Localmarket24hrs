<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido #{{ $order->id }} - LocalMarket 24hrs</title>
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
                    <a href="{{ route('marketplace.orders.index') }}" class="hover:text-gray-700 ml-1 transition-colors">Mis pedidos</a>
                    <span class="ml-1">/</span>
                    <span class="text-gray-600 font-medium ml-1">#{{ $order->id }}</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('marketplace.orders.index') }}"
                   class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Mis pedidos
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
                        <a href="{{ route('marketplace.orders.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Mis pedidos
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

<section class="bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 text-white py-10 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3 text-orange-200 text-sm mb-4">
            <a href="{{ route('marketplace.home') }}" class="hover:text-white transition-colors">Inicio</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('marketplace.orders.index') }}" class="hover:text-white transition-colors">Mis pedidos</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white font-medium">#{{ $order->id }}</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-black">Pedido #{{ $order->id }}</h1>
                <p class="text-orange-100 mt-0.5">Realizado el {{ $order->created_at->format('d/m/Y') }} a las {{ $order->created_at->format('H:i') }}</p>
            </div>
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

    @if (session('show_site_rating_prompt') && !$order->siteRating)
        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                <div>
                    <p class="text-sm font-semibold text-green-700">Tu opinión nos ayuda</p>
                    <h2 class="text-xl font-bold text-slate-900 mt-1">
                        ¿Quieres valorar nuestra página?
                    </h2>
                    <p id="rating-message" class="text-gray-500 mt-2">
                        Selecciona de 1 a 5 estrellas según cómo sentiste la experiencia.
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('marketplace.site-ratings.store') }}"
                      class="w-full lg:max-w-xl">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div id="rating-stars" class="flex justify-start gap-2">
                        @for ($star = 1; $star <= 5; $star++)
                            <input type="radio"
                                   id="rating-{{ $star }}"
                                   name="rating"
                                   value="{{ $star }}"
                                   class="hidden"
                                   data-message="@if ($star <= 2) Lamentamos que la experiencia no haya sido ideal. Cuéntanos qué podemos mejorar. @elseif ($star === 3) Gracias, tomaremos tu opinión para mejorar la plataforma. @else Nos alegra que la experiencia haya sido buena. Gracias por apoyar el mercado local. @endif">
                            <label for="rating-{{ $star }}"
                                   data-star="{{ $star }}"
                                   class="rating-star cursor-pointer text-4xl text-gray-300 transition-colors">
                                ★
                            </label>
                        @endfor
                    </div>

                    @error('rating')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror

                    <textarea name="comment"
                              rows="3"
                              placeholder="Comentario opcional"
                              class="mt-4 w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">{{ old('comment') }}</textarea>

                    @error('comment')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                            class="mt-3 px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Enviar valoración
                    </button>
                </form>
            </div>
        </section>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ITEMS --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">Productos comprados</h2>
                    <span class="text-sm text-gray-400">{{ $order->items->count() }} {{ $order->items->count() === 1 ? 'producto' : 'productos' }}</span>
                </div>

                <div class="divide-y divide-gray-50">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4 px-6 py-4 hover:bg-orange-50/30 transition-colors">
                            {{-- Placeholder image --}}
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-orange-50 to-amber-50 border border-orange-100 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-900 truncate">
                                    {{ $item->product->name ?? 'Producto eliminado' }}
                                </p>
                                <p class="text-sm text-gray-400 mt-0.5">
                                    {{ $item->product->commerce->name ?? 'Comercio eliminado' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $item->quantity }} × Q{{ number_format($item->unit_price, 2) }}
                                </p>
                            </div>

                            {{-- Subtotal --}}
                            <div class="text-right shrink-0">
                                <p class="font-black text-gray-900">Q{{ number_format($item->subtotal, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- SUMMARY SIDEBAR --}}
        <div class="space-y-4">

            {{-- Status card --}}
            <div class="reveal stagger-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Estado del pedido</p>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold border {{ $sc['color'] }}">
                        <span class="w-2 h-2 rounded-full {{ $sc['dot'] }} animate-pulse"></span>
                        {{ $sc['label'] }}
                    </span>
                </div>

                {{-- Progress steps --}}
                @php
                    $steps = ['pendiente', 'confirmado', 'en_preparacion', 'en_camino', 'entregado'];
                    $currentIdx = array_search($order->status, $steps);
                @endphp
                @if($order->status !== 'cancelado')
                    <div class="mt-4 space-y-2">
                        @foreach($steps as $i => $step)
                            @php
                                $stepLabels = ['Pendiente', 'Confirmado', 'En preparación', 'En camino', 'Entregado'];
                                $isDone = $currentIdx !== false && $i <= $currentIdx;
                            @endphp
                            <div class="flex items-center gap-2.5">
                                <div class="w-5 h-5 rounded-full flex items-center justify-center shrink-0
                                    {{ $isDone ? 'bg-orange-500' : 'bg-gray-100 border border-gray-200' }}">
                                    @if($isDone)
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    @endif
                                </div>
                                <span class="text-xs {{ $isDone ? 'font-semibold text-gray-800' : 'text-gray-400' }}">
                                    {{ $stepLabels[$i] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Order summary --}}
            <div class="reveal stagger-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Resumen</p>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Número de pedido</span>
                        <span class="font-semibold text-gray-900">#{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Fecha</span>
                        <span class="font-semibold text-gray-900">{{ $order->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Productos</span>
                        <span class="font-semibold text-gray-900">{{ $order->items->count() }}</span>
                    </div>
                    @if (!empty($order->discount_total) && $order->discount_total > 0)
                        <div class="flex justify-between text-green-600">
                            <span>Descuento @if($order->coupon_code)({{ $order->coupon_code }})@endif</span>
                            <span class="font-semibold">-Q{{ number_format($order->discount_total, 2) }}</span>
                        </div>
                    @endif
                    <div class="border-t border-gray-100 pt-3 flex justify-between">
                        <span class="font-bold text-gray-900">Total pagado</span>
                        <span class="font-black text-xl text-orange-500">Q{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="reveal stagger-3 space-y-2">
                <a href="{{ route('marketplace.home') }}"
                   class="btn-brand w-full py-3 rounded-xl text-sm justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Seguir comprando
                </a>
                <a href="{{ route('marketplace.orders.index') }}"
                   class="flex items-center justify-center gap-2 w-full py-3 rounded-xl text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:border-orange-300 hover:text-orange-600 transition-all">
                    Ver todos mis pedidos
                </a>
            </div>

        </div>

    </div>

</main>

<script>
    const ratingStars = document.querySelectorAll('.rating-star');
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    let selectedRating = 0;

    function paintStars(value) {
        ratingStars.forEach((star) => {
            star.classList.toggle('text-yellow-400', Number(star.dataset.star) <= value);
            star.classList.toggle('text-gray-300', Number(star.dataset.star) > value);
        });
    }

    ratingStars.forEach((star) => {
        star.addEventListener('mouseenter', () => paintStars(Number(star.dataset.star)));
        star.addEventListener('mouseleave', () => paintStars(selectedRating));
    });

    ratingInputs.forEach((input) => {
        input.addEventListener('change', () => {
            const message = document.getElementById('rating-message');
            selectedRating = Number(input.value);
            paintStars(selectedRating);

            if (message) {
                message.textContent = input.dataset.message;
            }
        });
    });
</script>

</body>
</html>
