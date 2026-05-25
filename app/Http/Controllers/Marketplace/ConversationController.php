<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Commerce;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('user_id', auth()->id())
            ->with(['commerce', 'latestMessage.sender'])
            ->latest('last_message_at')
            ->paginate(10);

        return view('marketplace.conversations.index', compact('conversations'));
    }

    public function start(Request $request, Commerce $commerce)
    {
        if ($commerce->status !== 'activo') {
            abort(404);
        }

        if ($commerce->user_id === auth()->id()) {
            return redirect()
                ->route('marketplace.commerces.show', $commerce)
                ->with('error', 'No puedes iniciar un chat con tu propio comercio.');
        }

        $conversation = Conversation::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'commerce_id' => $commerce->id,
                'order_id' => null,
            ],
            [
                'last_message_at' => now(),
            ]
        );

        if ($request->filled('body')) {
            $this->createMessage($conversation, $request);
        }

        return redirect()->route('marketplace.conversations.show', $conversation);
    }

    public function show(Conversation $conversation)
    {
        if ($conversation->user_id !== auth()->id()) {
            abort(403);
        }

        $conversation->load(['commerce', 'messages.sender']);

        return view('marketplace.conversations.show', compact('conversation'));
    }

    public function storeMessage(Request $request, Conversation $conversation)
    {
        if ($conversation->user_id !== auth()->id()) {
            abort(403);
        }

        $this->createMessage($conversation, $request);

        return redirect()->route('marketplace.conversations.show', $conversation);
    }

    private function createMessage(Conversation $conversation, Request $request): void
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'body' => $validated['body'],
        ]);

        $conversation->update([
            'last_message_at' => now(),
        ]);
    }
}
