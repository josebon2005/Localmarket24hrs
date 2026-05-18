@extends('admin.layouts.app')

@section('title', 'Crear Administrador')

@section('content')
    <div class="max-w-3xl">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Crear nuevo administrador</h1>
            <p class="text-gray-500 mt-1">
                Registra un nuevo usuario con permisos de administrador.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="POST" action="{{ route('admin.admin-users.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre completo
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500"
                           placeholder="Ejemplo: Juan Pérez">

                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Correo electrónico
                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500"
                           placeholder="admin@localmarket.com">

                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Contraseña
                    </label>

                    <input type="password"
                           id="password"
                           name="password"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500"
                           placeholder="Contraseña segura">

                    @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirmar contraseña
                    </label>

                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500"
                           placeholder="Repite la contraseña">
                </div>

                <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-sm">
                    Este usuario será creado automáticamente con rol de administrador y estado activo.
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Crear administrador
                    </button>

                    <a href="{{ route('admin.dashboard') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
