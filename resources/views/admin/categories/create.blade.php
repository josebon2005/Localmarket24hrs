@extends('admin.layouts.app')

@section('title', 'Nueva Categoría')

@section('content')
<div class="max-w-2xl space-y-6">

    {{-- HEADER --}}
    <div class="reveal relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 p-6 text-white">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="relative flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-2 text-orange-200 text-xs font-medium mb-0.5">
                    <a href="{{ route('admin.categories.index') }}" class="hover:text-white transition-colors">Categorías</a>
                    <span>/</span>
                    <span>Nueva</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black">Nueva categoría</h1>
                <p class="text-orange-100 text-sm mt-0.5">Crea una categoría para clasificar los comercios del sistema</p>
            </div>
        </div>
    </div>

    {{-- FORMULARIO --}}
    <div class="reveal bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
                    Nombre de la categoría <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       placeholder="Ej: Restaurantes, Tecnología, Ropa…"
                       class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all @error('name') border-red-400 @enderror">
                @error('name')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
                    Descripción
                </label>
                <textarea id="description" name="description" rows="4"
                          placeholder="Descripción breve de la categoría…"
                          class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all resize-none @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">
                    Estado
                </label>
                <select id="status" name="status"
                        class="w-full px-3 py-2.5 rounded-xl border-2 border-gray-200 text-sm focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none transition-all bg-white @error('status') border-red-400 @enderror">
                    <option value="activa"   {{ old('status', 'activa') === 'activa'   ? 'selected' : '' }}>Activa</option>
                    <option value="inactiva" {{ old('status') === 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                </select>
                @error('status')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                        class="py-2.5 px-6 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-lg shadow-orange-500/25 transition-all">
                    Guardar categoría
                </button>
                <a href="{{ route('admin.categories.index') }}"
                   class="py-2.5 px-5 rounded-xl text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-all">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
