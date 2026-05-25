<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chats - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Chats de {{ $commerce->name }}</h1>
            <p class="text-sm text-gray-500">Mensajes de clientes interesados</p>
        </div>

        <a href="{{ route('comerciante.dashboard') }}"
           class="px-4 py-2 rounded-lg bg-slate-900 text-white hover:bg-slate-800">
            Dashboard
        </a>
    </div>
</header>

<main class="max-w-5xl mx-auto px-6 py-8">
    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @forelse ($conversations as $conversation)
            <a href="{{ route('comerciante.conversations.show', $conversation) }}"
               class="block px-6 py-4 border-b border-gray-100 hover:bg-gray-50">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="font-bold text-slate-900">{{ $conversation->user->name }}</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $conversation->latestMessage?->body ?? 'Aun no hay mensajes.' }}
                        </p>
                    </div>

                    <span class="text-xs text-gray-400">
                        {{ $conversation->last_message_at?->format('d/m/Y H:i') ?? $conversation->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>
            </a>
        @empty
            <div class="p-10 text-center">
                <h2 class="text-xl font-bold text-slate-900">Todavia no hay chats</h2>
                <p class="text-gray-500 mt-2">Cuando un cliente contacte tu comercio, aparecera aqui.</p>
            </div>
        @endforelse

        <div class="px-6 py-4">
            {{ $conversations->links() }}
        </div>
    </section>
</main>

</body>
</html>
