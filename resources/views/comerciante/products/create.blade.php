<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear producto - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Crear producto</h1>
            <p class="text-sm text-gray-500">Agrega un nuevo producto a {{ $commerce->name }}</p>
        </div>

        <a href="{{ route('comerciante.products.index') }}"
           class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
            Volver
        </a>
    </div>
</header>

<main class="max-w-4xl mx-auto px-6 py-8">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <form method="POST"
              action="{{ route('comerciante.products.store') }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre del producto
                </label>

                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Ejemplo: Camisa azul"
                       class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

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
                          placeholder="Describe el producto"
                          class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">{{ old('description') }}</textarea>

                @error('description')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                    Imagen del producto
                </label>

                <input type="file"
                       id="image"
                       name="image"
                       accept="image/*"
                       class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

                <p class="text-xs text-gray-500 mt-1">
                    Formatos permitidos: JPG, JPEG, PNG o WEBP. Máximo 2MB.
                </p>

                @error('image')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                        Precio
                    </label>

                    <input type="number"
                           id="price"
                           name="price"
                           value="{{ old('price') }}"
                           step="0.01"
                           min="0"
                           placeholder="0.00"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

                    @error('price')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                        Stock
                    </label>

                    <input type="number"
                           id="stock"
                           name="stock"
                           value="{{ old('stock', 0) }}"
                           min="0"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

                    @error('stock')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="discount_percentage" class="block text-sm font-medium text-gray-700 mb-1">
                        Descuento %
                    </label>

                    <input type="number"
                           id="discount_percentage"
                           name="discount_percentage"
                           value="{{ old('discount_percentage', 0) }}"
                           step="0.01"
                           min="0"
                           max="100"
                           class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

                    @error('discount_percentage')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    Estado
                </label>

                <select id="status"
                        name="status"
                        class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                    <option value="activo" {{ old('status') === 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('status') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>

                @error('status')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                    Guardar producto
                </button>

                <a href="{{ route('comerciante.products.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Cancelar
                </a>
            </div>
        </form>
    </section>

</main>

</body>
</html>
