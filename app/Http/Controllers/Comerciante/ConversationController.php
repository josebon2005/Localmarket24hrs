<?php

namespace App\Http\Controllers\Comerciante;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $commerce = auth()->user()->commerce;

        if (!$commerce) {
            return redirect()
                ->route('comerciante.commerce.create')
                ->with('error', 'Primero debes crear tu comercio.');
        }

        $conversations = Conversation::where('commerce_id', $commerce->id)
            ->with(['user', 'latestMessage.sender'])
            ->latest('last_message_at')
            ->paginate(10);

        return view('comerciante.conversations.index', compact('commerce', 'conversations'));
    }

    public function show(Conversation $conversation)
    {
        $commerce = auth()->user()->commerce;

        if (!$commerce || $conversation->commerce_id !== $commerce->id) {
            abort(403, 'No tienes permiso para ver este chat.');
        }

        $conversation->load(['user', 'commerce', 'messages.sender']);

        return view('comerciante.conversations.show', compact('commerce', 'conversation'));
    }

    public function storeMessage(Request $request, Conversation $conversation)
    {
        $commerce = auth()->user()->commerce;

        if (!$commerce || $conversation->commerce_id !== $commerce->id) {
            abort(403, 'No tienes permiso para responder este chat.');
        }

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

        return redirect()->route('comerciante.conversations.show', $conversation);
    }
}