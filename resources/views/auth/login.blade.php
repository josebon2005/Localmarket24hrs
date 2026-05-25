<x-guest-layout>
    <div class="mb-7">
        <h2 class="text-2xl font-bold text-gray-900">Bienvenido de vuelta 👋</h2>
        <p class="text-gray-500 mt-1.5 text-sm">Ingresa a tu cuenta para continuar comprando.</p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <x-text-input id="email" class="pl-11" type="email" name="email"
                              :value="old('email')" required autofocus autocomplete="username"
                              placeholder="tu@correo.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" />
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <x-input-label for="password" :value="__('Contraseña')" class="mb-0" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-xs text-orange-500 font-semibold hover:text-orange-600 transition-colors">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <x-text-input id="password" class="pl-11" type="password" name="password"
                              required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" />
        </div>

        {{-- Remember me --}}
        <label class="flex items-center gap-2.5 cursor-pointer group">
            <input id="remember_me" type="checkbox" name="remember"
                   class="w-4 h-4 rounded border-gray-300 text-orange-500 focus:ring-orange-500 cursor-pointer">
            <span class="text-sm text-gray-600 group-hover:text-gray-800 transition-colors">Recordarme</span>
        </label>

        {{-- Submit --}}
        <x-primary-button class="w-full py-3.5 text-base">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Iniciar sesión
        </x-primary-button>

        <p class="text-center text-sm text-gray-500">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-orange-500 font-semibold hover:text-orange-600 transition-colors ml-1">
                Regístrate gratis →
            </a>
        </p>
    </form>
</x-guest-layout>
