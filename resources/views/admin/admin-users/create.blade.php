@extends('admin.layouts.app')

@section('title', 'Nuevo Administrador')

@section('content')
<div class="max-w-2xl space-y-6">

    {{-- HEADER --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 text-white">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 text-orange-200 text-xs font-medium mb-0.5">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dashboard</a>
                    <span>/</span>
                    <span>Nuevo administrador</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black">Nuevo administrador</h1>
                <p class="text-orange-100 text-sm mt-0.5">Registra un usuario con permisos de administrador en la plataforma</p>
            </div>
        </div>
    </div>

    {{-- FORMULARIO --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="{{ route('admin.admin-users.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
                    Nombre completo <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       placeholder="Ej: Juan Pérez"
                       class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
                    Correo electrónico <span class="text-red-500">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       placeholder="admin@localmarket.com"
                       class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all @error('email') border-red-400 @enderror">
                @error('email')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
                    Contraseña <span class="text-red-500">*</span>
                </label>
                <input type="password" id="password" name="password"
                       placeholder="Mínimo 8 caracteres"
                       class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all @error('password') border-red-400 @enderror">
                @error('password')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
                    Confirmar contraseña <span class="text-red-500">*</span>
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Repite la contraseña"
                       class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all">
            </div>

            {{-- Info box --}}
            <div class="flex items-start gap-3 p-4 rounded-xl bg-orange-50 border border-orange-200">
                <svg class="w-5 h-5 text-orange-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-orange-700 font-medium">
                    Este usuario será creado con rol de <span class="font-bold">administrador</span> y estado activo de forma automática.
                </p>
            </div>

            <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                        class="py-2.5 px-6 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 transition-all">
                    Crear administrador
                </button>
                <a href="{{ route('admin.dashboard') }}"
                   class="py-2.5 px-5 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
