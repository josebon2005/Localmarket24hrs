<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chats del comercio - LocalMarket 24hrs</title>
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
                    <a href="{{ route('comerciante.dashboard') }}" class="hover:text-gray-700 ml-1 transition-colors">Panel</a>
                    <span class="ml-1">/</span>
                    <span class="text-gray-600 font-medium ml-1">Chats</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('comerciante.dashboard') }}"
                   class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/></svg>
                    Panel
                </a>
                <a href="{{ route('comerciante.orders.index') }}"
                   class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Pedidos
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
                        <a href="{{ route('marketplace.home') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Ver marketplace
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

{{-- HERO HEADER --}}
<section class="bg-gradient-to-br from-slate-800 via-slate-900 to-gray-900 text-white py-10 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center gap-3 text-slate-400 text-sm mb-4">
            <a href="{{ route('comerciante.dashboard') }}" class="hover:text-white transition-colors">Panel</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white font-medium">Chats</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center">
                <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-black">Mensajes de clientes</h1>
                <p class="text-slate-400 mt-0.5">
                    {{ $commerce->name }}
                    @if($conversations->total() > 0)
                        · {{ $conversations->total() }} {{ $conversations->total() === 1 ? 'conversación' : 'conversaciones' }}
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>

{{-- MAIN CONTENT --}}
<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    @if(session('error'))
        <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-2xl">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    @if($conversations->count() > 0)
        <div class="space-y-3">
            @foreach($conversations as $conversation)
                <a href="{{ route('comerciante.conversations.show', $conversation) }}"
                   class="reveal group flex items-center gap-4 bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-gray-100 hover:border-orange-200 hover:shadow-md transition-all duration-200">

                    {{-- Buyer Avatar --}}
                    <div class="relative shrink-0">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-500 to-slate-700 flex items-center justify-center text-white font-black text-xl shadow-md">
                            {{ strtoupper(substr($conversation->user->name, 0, 1)) }}
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <h3 class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors truncate">
                                {{ $conversation->user->name }}
                            </h3>
                            <span class="text-xs text-gray-400 shrink-0">
                                {{ $conversation->last_message_at?->diffForHumans() ?? $conversation->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 mb-1.5">{{ $conversation->user->email }}</p>
                        <p class="text-sm text-gray-500 truncate">
                            @if($conversation->latestMessage)
                                @if($conversation->latestMessage->sender_id === auth()->id())
                                    <span class="text-gray-400">Tú: </span>
                                @else
                                    <span class="inline-block w-2 h-2 rounded-full bg-orange-400 mr-1 align-middle"></span>
                                @endif
                                {{ $conversation->latestMessage->body }}
                            @else
                                <span class="italic">Sin mensajes aún</span>
                            @endif
                        </p>
                    </div>

                    <svg class="w-5 h-5 text-gray-300 group-hover:text-orange-400 group-hover:translate-x-1 transition-all shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endforeach
        </div>

        @if($conversations->hasPages())
            <div class="mt-8">
                {{ $conversations->links() }}
            </div>
        @endif

    @else
        {{-- Empty state --}}
        <div class="reveal text-center py-20">
            <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-slate-100 to-gray-50 flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-slate-200">
                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-black text-gray-900 mb-2">Aún no tienes mensajes</h2>
            <p class="text-gray-500 mb-8 max-w-sm mx-auto">
                Cuando un cliente te escriba desde tu comercio, el chat aparecerá aquí.
            </p>
            <a href="{{ route('comerciante.dashboard') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-slate-800 hover:bg-slate-700 shadow-lg transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/></svg>
                Ir al panel
            </a>
        </div>
    @endif

</main>

</body>
</html>
