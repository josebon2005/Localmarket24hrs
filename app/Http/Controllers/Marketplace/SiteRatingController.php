<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SiteRating;
use Illuminate\Http\Request;

class SiteRatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        $order = Order::where('id', $validated['order_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $rating = SiteRating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'order_id' => $order->id,
            ],
            [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
                'source' => 'post_order',
            ]
        );

        return redirect()
            ->route('marketplace.orders.show', $order)
            ->with('success', $rating->responseMessage());
    }
}
