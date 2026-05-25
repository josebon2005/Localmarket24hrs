<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LocalMarket 24hrs') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="min-h-screen flex">

    {{-- ── Brand panel ──────────────────────────── --}}
    <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 relative overflow-hidden flex-col items-center justify-center">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-500 via-orange-600 to-amber-700"></div>

        {{-- Decorative blobs --}}
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 right-0 w-64 h-64 bg-orange-400/15 rounded-full blur-2xl"></div>

        {{-- Dot grid overlay --}}
        <div class="absolute inset-0 opacity-10"
             style="background-image:radial-gradient(circle,#fff 1px,transparent 1px);background-size:28px 28px"></div>

        {{-- Content --}}
        <div class="relative z-10 text-white px-12 xl:px-16 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-3xl mb-8 shadow-2xl backdrop-blur-sm border border-white/30">
                <span class="text-4xl">🛍️</span>
            </div>

            <h1 class="text-4xl xl:text-5xl font-extrabold tracking-tight mb-4 leading-none">
                LocalMarket<br><span class="text-amber-300">24hrs</span>
            </h1>

            <p class="text-orange-100 text-lg leading-relaxed max-w-xs mx-auto mb-12">
                Conectamos comercios locales con compradores cercanos, disponible las 24 horas del día.
            </p>

            <div class="grid grid-cols-3 gap-4 mb-10">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                    <div class="text-2xl font-bold">100+</div>
                    <div class="text-orange-200 text-xs mt-1">Comercios</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                    <div class="text-2xl font-bold">24/7</div>
                    <div class="text-orange-200 text-xs mt-1">Disponible</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
                    <div class="text-2xl font-bold">∞</div>
                    <div class="text-orange-200 text-xs mt-1">Productos</div>
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/20 text-left">
                <div class="flex gap-1 mb-3">
                    @for($s=0;$s<5;$s++)
                        <svg class="w-4 h-4 text-amber-300 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
                <p class="text-sm text-orange-100 italic leading-relaxed">
                    "Gracias a LocalMarket 24hrs pude digitalizar mi negocio y llegar a más clientes en mi ciudad."
                </p>
                <div class="flex items-center gap-3 mt-4">
                    <div class="w-8 h-8 rounded-full bg-white/30 flex items-center justify-center text-sm font-bold">M</div>
                    <div>
                        <div class="text-xs font-semibold">María G.</div>
                        <div class="text-xs text-orange-200">Comerciante local</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Form panel ───────────────────────────── --}}
    <div class="flex-1 flex flex-col items-center justify-center px-6 py-12 bg-gray-50/50">
        <div class="w-full max-w-md">

            {{-- Mobile logo --}}
            <div class="lg:hidden text-center mb-8">
                <a href="{{ route('marketplace.home') }}" class="inline-flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-600 flex items-center justify-center shadow-lg shadow-orange-500/30">
                        <span class="text-white text-lg font-black">L</span>
                    </div>
                    <span class="text-xl font-extrabold text-gray-900">
                        Local<span class="text-orange-500">Market</span>
                        <span class="text-sm font-medium text-gray-400 ml-0.5">24hrs</span>
                    </span>
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/60 border border-gray-100 p-8">
                {{ $slot }}
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('marketplace.home') }}"
                   class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
