<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat con {{ $conversation->user->name }} - LocalMarket 24hrs</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">{{ $conversation->user->name }}</h1>
            <p class="text-sm text-gray-500">Chat con cliente de {{ $commerce->name }}</p>
        </div>

        <a href="{{ route('comerciante.conversations.index') }}"
           class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">
            Chats
        </a>
    </div>
</header>

<main class="max-w-5xl mx-auto px-6 py-8">
    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <div class="space-y-4 min-h-80">
            @forelse ($conversation->messages as $message)
                @php($isMine = $message->sender_id === auth()->id())
                <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-lg rounded-2xl px-4 py-3 {{ $isMine ? 'bg-slate-900 text-white' : 'bg-gray-100 text-gray-800' }}">
                        <p class="text-sm">{{ $message->body }}</p>
                        <p class="text-xs mt-2 {{ $isMine ? 'text-slate-300' : 'text-gray-500' }}">
                            {{ $message->sender->name }} · {{ $message->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <h2 class="text-xl font-bold text-slate-900">Chat sin mensajes</h2>
                    <p class="text-gray-500 mt-2">Responde cuando el cliente envie su primera consulta.</p>
                </div>
            @endforelse
        </div>

        <form method="POST"
              action="{{ route('comerciante.conversations.messages.store', $conversation) }}"
              class="mt-6 border-t pt-5">
            @csrf
            <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
            <textarea id="body"
                      name="body"
                      rows="3"
                      class="w-full rounded-lg border-gray-300 focus:border-slate-500 focus:ring-slate-500"
                      placeholder="Escribe tu respuesta...">{{ old('body') }}</textarea>
            @error('body')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
            <button type="submit"
                    class="mt-3 px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">
                Enviar respuesta
            </button>
        </form>
    </section>
</main>

</body>
</html>
