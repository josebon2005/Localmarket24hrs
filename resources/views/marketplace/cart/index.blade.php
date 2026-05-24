<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Carrito de compras</h1>
            <p class="text-sm text-gray-500">Revisa tus productos antes de confirmar el pedido</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('marketplace.home') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Seguir comprando
            </a>

            <a href="{{ route('marketplace.orders.index') }}"
               class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                Mis pedidos
            </a>
        </div>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-8">

    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if ($cart->items->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <section class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 border-b">
                        <tr>
                            <th class="px-6 py-3">Producto</th>
                            <th class="px-6 py-3">Precio</th>
                            <th class="px-6 py-3">Cantidad</th>
                            <th class="px-6 py-3">Subtotal</th>
                            <th class="px-6 py-3 text-right">Acciones</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                        @foreach ($cart->items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                 alt="{{ $item->product->name }}"
                                                 class="w-16 h-16 object-cover rounded-lg border">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-500">
                                                Sin imagen
                                            </div>
                                        @endif

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $item->product->name }}
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                {{ $item->product->commerce->name ?? 'Sin comercio' }}
                                            </p>

                                            <p class="text-xs text-gray-400 mt-1">
                                                Stock disponible: {{ $item->product->stock }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($item->product->discount_percentage > 0)
                                        <p class="text-xs text-gray-400 line-through">
                                            Q{{ number_format($item->product->price, 2) }}
                                        </p>

                                        <p class="font-semibold text-green-700">
                                            Q{{ number_format($item->product->finalPrice(), 2) }}
                                        </p>
                                    @else
                                        <p class="font-semibold text-gray-800">
                                            Q{{ number_format($item->product->price, 2) }}
                                        </p>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <form method="POST"
                                          action="{{ route('marketplace.cart.update', $item) }}"
                                          class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')

                                        <input type="number"
                                               name="quantity"
                                               value="{{ $item->quantity }}"
                                               min="1"
                                               max="{{ $item->product->stock }}"
                                               class="w-20 rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">

                                        <button type="submit"
                                                class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                                            Actualizar
                                        </button>
                                    </form>
                                </td>

                                <td class="px-6 py-4 font-bold text-gray-800">
                                    Q{{ number_format($item->subtotal(), 2) }}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form method="POST"
                                          action="{{ route('marketplace.cart.destroy', $item) }}"
                                          onsubmit="return confirm('¿Eliminar este producto del carrito?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <aside class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 h-fit">
                <h2 class="text-xl font-bold text-slate-900">Resumen</h2>

                <div class="mt-5 space-y-3">
                    <div class="flex justify-between text-gray-600">
                        <span>Productos</span>
                        <span>{{ $cart->items->sum('quantity') }}</span>
                    </div>

                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Q{{ number_format($cart->total(), 2) }}</span>
                    </div>

                    @if ($coupon)
                        <div class="flex justify-between text-green-700">
                            <span>Cupón {{ $coupon->code }}</span>
                            <span>-Q{{ number_format($discountTotal, 2) }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between text-gray-600">
                        <span>Total</span>
                        <span class="font-bold text-slate-900">
                            Q{{ number_format(max($cart->total() - $discountTotal, 0), 2) }}
                        </span>
                    </div>
                </div>

                <div class="mt-6 border-t pt-5">
                    @if ($coupon)
                        <form method="POST" action="{{ route('marketplace.cart.coupon.remove') }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="w-full px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                                Quitar cupón
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('marketplace.cart.coupon.apply') }}" class="space-y-3">
                            @csrf

                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                                    Cupón
                                </label>
                                <input type="text"
                                       name="code"
                                       id="code"
                                       placeholder="Ej. LOCAL10"
                                       class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">
                                @error('code')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                    class="w-full px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                                Aplicar cupón
                            </button>
                        </form>
                    @endif
                </div>

                <form method="POST" action="{{ route('marketplace.orders.store') }}" class="mt-6">
                    @csrf

                    <button type="submit"
                            class="w-full px-4 py-3 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Confirmar pedido
                    </button>
                </form>

                <form method="POST"
                      action="{{ route('marketplace.cart.clear') }}"
                      class="mt-3"
                      onsubmit="return confirm('¿Seguro que deseas vaciar el carrito?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="w-full px-4 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Vaciar carrito
                    </button>
                </form>
            </aside>

        </div>
    @else
        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-10 text-center">
            <h2 class="text-2xl font-bold text-slate-900">
                Tu carrito está vacío
            </h2>

            <p class="text-gray-500 mt-2">
                Agrega productos desde los comercios para iniciar un pedido.
            </p>

            <a href="{{ route('marketplace.home') }}"
               class="inline-block mt-6 px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                Ir al marketplace
            </a>
        </section>
    @endif

</main>

</body>
</html>
