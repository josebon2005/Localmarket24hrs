<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear comercio - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Crear comercio</h1>
            <p class="text-sm text-gray-500">Registra tu negocio en LocalMarket 24hrs</p>
        </div>

        <a href="{{ route('marketplace.home') }}"
           class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
            Volver al marketplace
        </a>
    </div>
</header>

<main class="max-w-4xl mx-auto px-6 py-8">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-slate-900">
                Datos de tu comercio
            </h2>

            <p class="text-gray-500 mt-2">
                Completa la información básica de tu negocio. Las categorías son creadas por el administrador.
            </p>
        </div>

        <form method="POST" action="{{ route('comerciante.commerce.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre del comercio
                </label>

                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Ejemplo: Tienda Don José"
                       class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

                @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Categoría
                </label>

                <select id="category_id"
                        name="category_id"
                        class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                    <option value="">Selecciona una categoría</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
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
                          placeholder="Describe brevemente tu comercio"
                          class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">{{ old('description') }}</textarea>

                @error('description')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                        Dirección
                    </label>

                    <input type="text"
                           id="address"
                           name="address"
                           value="{{ old('address') }}"
                           placeholder="Dirección del negocio"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

                    @error('address')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                        Teléfono o WhatsApp
                    </label>

                    <input type="text"
                           id="phone"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="Ejemplo: 5555-5555"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

                    @error('phone')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-sm">
                Al crear tu comercio, tu cuenta cambiará automáticamente a rol de comerciante.
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                    Crear comercio
                </button>

                <a href="{{ route('marketplace.home') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Cancelar
                </a>
            </div>
        </form>
    </section>

</main>

</body>
</html>
