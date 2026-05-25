<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido #{{ $order->id }} - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Pedido #{{ $order->id }}
            </h1>

            <p class="text-sm text-gray-500">
                Detalle del pedido realizado
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('marketplace.orders.index') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Mis pedidos
            </a>

            <a href="{{ route('marketplace.home') }}"
               class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                Marketplace
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

    @if (session('show_site_rating_prompt') && !$order->siteRating)
        <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                <div>
                    <p class="text-sm font-semibold text-green-700">Tu opinión nos ayuda</p>
                    <h2 class="text-xl font-bold text-slate-900 mt-1">
                        ¿Quieres valorar nuestra página?
                    </h2>
                    <p id="rating-message" class="text-gray-500 mt-2">
                        Selecciona de 1 a 5 estrellas según cómo sentiste la experiencia.
                    </p>
                </div>

                <form method="POST"
                      action="{{ route('marketplace.site-ratings.store') }}"
                      class="w-full lg:max-w-xl">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div class="flex flex-row-reverse justify-end gap-2">
                        @for ($star = 5; $star >= 1; $star--)
                            <input type="radio"
                                   id="rating-{{ $star }}"
                                   name="rating"
                                   value="{{ $star }}"
                                   class="peer/rating{{ $star }} hidden"
                                   data-message="@if ($star <= 2) Lamentamos que la experiencia no haya sido ideal. Cuéntanos qué podemos mejorar. @elseif ($star === 3) Gracias, tomaremos tu opinión para mejorar la plataforma. @else Nos alegra que la experiencia haya sido buena. Gracias por apoyar el mercado local. @endif">
                            <label for="rating-{{ $star }}"
                                   class="cursor-pointer text-4xl text-gray-300 hover:text-yellow-400 peer-checked/rating{{ $star }}:text-yellow-400">
                                ★
                            </label>
                        @endfor
                    </div>

                    @error('rating')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror

                    <textarea name="comment"
                              rows="3"
                              placeholder="Comentario opcional"
                              class="mt-4 w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500">{{ old('comment') }}</textarea>

                    @error('comment')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                            class="mt-3 px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                        Enviar valoración
                    </button>
                </form>
            </div>
        </section>
    @endif

    <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Estado</p>
            <h2 class="text-xl font-bold text-slate-900 mt-2">
                {{ $order->statusLabel() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Fecha</p>
            <h2 class="text-xl font-bold text-slate-900 mt-2">
                {{ $order->created_at->format('d/m/Y') }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Descuento</p>
            <h2 class="text-xl font-bold text-green-700 mt-2">
                Q{{ number_format($order->discount_total, 2) }}
            </h2>
            @if ($order->coupon_code)
                <p class="text-xs text-gray-500">Cupón {{ $order->coupon_code }}</p>
            @endif
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-sm text-gray-500">Total</p>
            <h2 class="text-xl font-bold text-slate-900 mt-2">
                Q{{ number_format($order->total, 2) }}
            </h2>
        </div>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-bold text-slate-900">
                Productos comprados
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 border-b">
                <tr>
                    <th class="px-6 py-3">Producto</th>
                    <th class="px-6 py-3">Comercio</th>
                    <th class="px-6 py-3">Cantidad</th>
                    <th class="px-6 py-3">Precio unitario</th>
                    <th class="px-6 py-3">Subtotal</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                @foreach ($order->items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $item->product->name ?? 'Producto eliminado' }}
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $item->commerce->name ?? 'Comercio eliminado' }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $item->quantity }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            Q{{ number_format($item->unit_price, 2) }}
                        </td>

                        <td class="px-6 py-4 font-bold text-gray-800">
                            Q{{ number_format($item->subtotal, 2) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

</main>

<script>
    document.querySelectorAll('input[name="rating"]').forEach((input) => {
        input.addEventListener('change', () => {
            const message = document.getElementById('rating-message');

            if (message) {
                message.textContent = input.dataset.message;
            }
        });
    });
</script>

</body>
</html>
