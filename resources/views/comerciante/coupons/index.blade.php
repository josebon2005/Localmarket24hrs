<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cupones - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Cupones del comercio</h1>
            <p class="text-sm text-gray-500">Promociones creadas por {{ $commerce->name }}</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('comerciante.dashboard') }}"
               class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
                Dashboard
            </a>

            <a href="{{ route('comerciante.coupons.create') }}"
               class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                Crear cupón
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

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 border-b">
                <tr>
                    <th class="px-6 py-3">Código</th>
                    <th class="px-6 py-3">Descuento</th>
                    <th class="px-6 py-3">Uso</th>
                    <th class="px-6 py-3">Vigencia</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                @forelse ($coupons as $coupon)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <p class="font-bold text-gray-800">{{ $coupon->code }}</p>
                            <p class="text-xs text-gray-500">{{ $coupon->description ?? 'Sin descripción' }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            @if ($coupon->type === 'fixed')
                                Q{{ number_format($coupon->value, 2) }}
                            @else
                                {{ number_format($coupon->value, 0) }}%
                            @endif
                            <p class="text-xs text-gray-500">Mínimo Q{{ number_format($coupon->minimum_total, 2) }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $coupon->used_count }} / {{ $coupon->usage_limit ?? 'Sin límite' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $coupon->starts_at?->format('d/m/Y') ?? 'Hoy' }}
                            -
                            {{ $coupon->expires_at?->format('d/m/Y') ?? 'Sin vencimiento' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full {{ $coupon->status === 'activo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($coupon->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('comerciante.coupons.edit', $coupon) }}"
                                   class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200">
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('comerciante.coupons.toggle-status', $coupon) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200">
                                        {{ $coupon->status === 'activo' ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('comerciante.coupons.destroy', $coupon) }}"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este cupón?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Todavía no tienes cupones para tu comercio.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t">
            {{ $coupons->links() }}
        </div>
    </section>
</main>

</body>
</html>
