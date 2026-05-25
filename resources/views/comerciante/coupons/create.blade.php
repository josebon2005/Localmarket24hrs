<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear cupón - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<main class="max-w-4xl mx-auto px-6 py-8">
    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-slate-900">Nuevo cupón para {{ $commerce->name }}</h1>
        <p class="text-gray-500 mt-1 mb-6">Este descuento aplicará solo a productos de tu comercio.</p>

        <form method="POST" action="{{ route('comerciante.coupons.store') }}">
            @include('comerciante.coupons._form')
        </form>
    </section>
</main>

</body>
</html>
