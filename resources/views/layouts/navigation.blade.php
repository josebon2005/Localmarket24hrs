<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 8 })"
     :class="scrolled ? 'shadow-lg shadow-gray-200/50' : ''"
     class="sticky top-0 z-50 glass border-b border-gray-100/80 transition-shadow duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-500 to-amber-600 flex items-center justify-center shadow-md shadow-orange-500/30 group-hover:scale-105 transition-transform duration-200">
                    <span class="text-white font-black text-sm">L</span>
                </div>
                <span class="font-extrabold text-gray-900 text-lg leading-none">
                    Local<span class="text-orange-500">Market</span>
                    <span class="text-xs font-medium text-gray-400 ml-0.5">24hrs</span>
                </span>
            </a>

            {{-- Desktop links --}}
            <div class="hidden sm:flex items-center gap-1">
                <a href="{{ route('dashboard') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-150
                          {{ request()->routeIs('dashboard') ? 'bg-orange-50 text-orange-600 font-semibold' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    Dashboard
                </a>
            </div>

            {{-- User dropdown --}}
            <div class="hidden sm:flex items-center gap-3">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-gray-200 bg-white hover:border-orange-200 hover:bg-orange-50 transition-all duration-150 group">
                            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-gray-700 max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-xs text-gray-400 mb-0.5">Sesión iniciada como</p>
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Perfil
                            </span>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <span class="flex items-center gap-2 text-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Cerrar sesión
                                </span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger --}}
            <button @click="open = !open"
                    class="-me-2 sm:hidden flex items-center justify-center p-2 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-gray-100 bg-white">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium
                      {{ request()->routeIs('dashboard') ? 'bg-orange-50 text-orange-600' : 'text-gray-700 hover:bg-gray-100' }}">
                Dashboard
            </a>
        </div>
        <div class="border-t border-gray-100 px-4 py-4">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center text-white text-sm font-bold shadow-md">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                    Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm text-red-600 hover:bg-red-50 transition-colors">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
