<x-guest-layout>
    <div class="mb-7">
        <h2 class="text-2xl font-bold text-gray-900">Crea tu cuenta 🚀</h2>
        <p class="text-gray-500 mt-1.5 text-sm">Únete a LocalMarket y empieza a comprar en comercios locales.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Nombre completo')" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <x-text-input id="name" class="pl-11" type="text" name="name"
                              :value="old('name')" required autofocus autocomplete="name"
                              placeholder="Tu nombre completo" />
            </div>
            <x-input-error :messages="$errors->get('name')" />
        </div>

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
                              :value="old('email')" required autocomplete="username"
                              placeholder="tu@correo.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <x-text-input id="password" class="pl-11" type="password" name="password"
                              required autocomplete="new-password" placeholder="Mínimo 8 caracteres" />
            </div>
            <x-input-error :messages="$errors->get('password')" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="pl-11" type="password"
                              name="password_confirmation" required autocomplete="new-password"
                              placeholder="Repite tu contraseña" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        {{-- Submit --}}
        <x-primary-button class="w-full py-3.5 text-base">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Crear cuenta gratis
        </x-primary-button>

        <p class="text-center text-sm text-gray-500">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:text-orange-600 transition-colors ml-1">
                Inicia sesión →
            </a>
        </p>
    </form>
</x-guest-layout>
