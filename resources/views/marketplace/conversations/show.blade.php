<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat con {{ $conversation->commerce->name }} - LocalMarket 24hrs</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .chat-bubble-mine {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            border-radius: 1.25rem 1.25rem 0.25rem 1.25rem;
        }
        .chat-bubble-theirs {
            background: white;
            color: #111827;
            border: 1px solid #f3f4f6;
            border-radius: 1.25rem 1.25rem 1.25rem 0.25rem;
        }
        #chat-messages {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased h-screen flex flex-col">

{{-- NAVBAR --}}
<nav x-data="{ scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
     :class="scrolled ? 'shadow-md' : 'shadow-sm'"
     class="shrink-0 glass border-b border-white/60 transition-shadow duration-300 z-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="flex items-center h-16 gap-3">
            <a href="{{ route('marketplace.conversations.index') }}"
               class="p-2 rounded-xl text-gray-500 hover:text-orange-500 hover:bg-orange-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>

            {{-- Commerce info --}}
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="relative shrink-0">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-black text-base shadow-sm">
                        {{ strtoupper(substr($conversation->commerce->name, 0, 1)) }}
                    </div>
                    <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full bg-green-400 border-2 border-white"></div>
                </div>
                <div class="min-w-0">
                    <h1 class="font-bold text-gray-900 truncate">{{ $conversation->commerce->name }}</h1>
                    <p class="text-xs text-gray-500">
                        @if($conversation->commerce->category){{ $conversation->commerce->category->name }} · @endif
                        Comercio local
                    </p>
                </div>
            </div>

            <a href="{{ route('marketplace.home') }}"
               class="hidden sm:flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Inicio
            </a>
        </div>
    </div>
</nav>

{{-- CHAT AREA --}}
<div class="flex-1 overflow-hidden flex flex-col max-w-5xl w-full mx-auto px-4 sm:px-6 py-4">
    <div id="chat-messages" class="flex-1 overflow-y-auto space-y-4 pb-4 pr-1">

        @if($conversation->messages->isEmpty())
            <div class="flex flex-col items-center justify-center h-full py-16 text-center">
                <div class="w-20 h-20 rounded-3xl bg-orange-50 flex items-center justify-center mb-4 border-2 border-dashed border-orange-200">
                    <svg class="w-9 h-9 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Inicia la conversación</h3>
                <p class="text-sm text-gray-500 max-w-xs">Envía el primer mensaje a <strong>{{ $conversation->commerce->name }}</strong> y te responderán pronto.</p>
            </div>
        @else
            @php $prevDate = null; @endphp
            @foreach($conversation->messages as $message)
                @php
                    $msgDate = $message->created_at->format('Y-m-d');
                    $isMine = $message->sender_id === auth()->id();
                @endphp

                @if($msgDate !== $prevDate)
                    <div class="flex items-center gap-3 my-4">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-xs text-gray-400 font-medium px-2">
                            {{ $message->created_at->isToday() ? 'Hoy' : ($message->created_at->isYesterday() ? 'Ayer' : $message->created_at->format('d/m/Y')) }}
                        </span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>
                    @php $prevDate = $msgDate; @endphp
                @endif

                <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }} items-end gap-2">
                    @if(!$isMine)
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-bold text-xs shrink-0 mb-0.5">
                            {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="max-w-xs sm:max-w-sm lg:max-w-md">
                        @if(!$isMine)
                            <p class="text-xs text-gray-500 mb-1 ml-1">{{ $message->sender->name }}</p>
                        @endif
                        <div class="{{ $isMine ? 'chat-bubble-mine' : 'chat-bubble-theirs shadow-sm' }} px-4 py-2.5 text-sm leading-relaxed">
                            {{ $message->body }}
                        </div>
                        <p class="text-xs text-gray-400 mt-1 {{ $isMine ? 'text-right mr-1' : 'ml-1' }}">
                            {{ $message->created_at->format('H:i') }}
                        </p>
                    </div>

                    @if($isMine)
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center text-white font-bold text-xs shrink-0 mb-0.5">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    {{-- MESSAGE INPUT --}}
    <div class="shrink-0 pt-3 border-t border-gray-200">
        <form method="POST" action="{{ route('marketplace.conversations.messages.store', $conversation) }}"
              class="flex items-end gap-3">
            @csrf
            <div class="flex-1">
                <textarea name="body"
                          rows="1"
                          placeholder="Escribe un mensaje..."
                          required
                          maxlength="1000"
                          onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();this.form.submit();}"
                          class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200 bg-white text-gray-900 placeholder-gray-400 resize-none transition-all duration-200 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 focus:outline-none text-sm max-h-32"
                          style="field-sizing: content; min-height: 48px;"></textarea>
                @error('body')
                    <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    class="shrink-0 w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 text-white flex items-center justify-center shadow-lg shadow-orange-500/30 hover:from-orange-600 hover:to-orange-700 active:scale-95 transition-all duration-200 mb-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </button>
        </form>
        <p class="text-xs text-gray-400 mt-1.5 ml-1">Presiona Enter para enviar, Shift+Enter para nueva línea</p>
    </div>
</div>

<script>
    // Scroll to bottom on load
    const chatEl = document.getElementById('chat-messages');
    if (chatEl) chatEl.scrollTop = chatEl.scrollHeight;
</script>

</body>
</html>
