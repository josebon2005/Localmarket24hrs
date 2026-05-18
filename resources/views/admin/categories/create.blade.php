@extends('admin.layouts.app')

@section('title', 'Crear Categoría')

@section('content')
    <div class="max-w-3xl">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Nueva categoría</h1>
            <p class="text-gray-500 mt-1">
                Crea una categoría para clasificar los comercios del sistema.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre de la categoría
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500"
                           placeholder="Ejemplo: Restaurantes">

                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Descripción
                    </label>

                    <textarea id="description"
                              name="description"
                              rows="4"
                              class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500"
                              placeholder="Descripción breve de la categoría">{{ old('description') }}</textarea>

                    @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                        Estado
                    </label>

                    <select id="status"
                            name="status"
                            class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                        <option value="activa" {{ old('status') === 'activa' ? 'selected' : '' }}>Activa</option>
                        <option value="inactiva" {{ old('status') === 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                    </select>

                    @error('status')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Guardar categoría
                    </button>

                    <a href="{{ route('admin.categories.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>
@endsection
