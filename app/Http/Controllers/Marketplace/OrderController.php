<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->with('items.product.commerce')
            ->latest()
            ->paginate(10);

        return view('marketplace.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product.commerce');

        return view('marketplace.orders.show', compact('order'));
    }

    public function store()
    {
        $cart = Cart::with('items.product.commerce')
            ->where('user_id', auth()->id())
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('marketplace.cart.index')
                ->with('error', 'Tu carrito está vacío.');
        }

        foreach ($cart->items as $item) {
            if ($item->product->status !== 'activo' || $item->product->commerce->status !== 'activo') {
                return redirect()
                    ->route('marketplace.cart.index')
                    ->with('error', 'Uno de los productos ya no está disponible.');
            }

            if ($item->quantity > $item->product->stock) {
                return redirect()
                    ->route('marketplace.cart.index')
                    ->with('error', 'No hay suficiente stock para ' . $item->product->name . '.');
            }
        }

        $order = DB::transaction(function () use ($cart) {
            $total = $cart->items->sum(function ($item) {
                return $item->subtotal();
            });
            $coupon = Coupon::find(session('cart_coupon_id'));
            $couponSubtotal = $coupon ? $coupon->applicableSubtotal($cart->items) : 0;
            $discountTotal = ($coupon && $coupon->isAvailableFor($couponSubtotal)) ? $coupon->discountFor($couponSubtotal) : 0;
            $finalTotal = max($total - $discountTotal, 0);

            $order = Order::create([
                'user_id' => auth()->id(),
                'coupon_id' => $discountTotal > 0 ? $coupon->id : null,
                'coupon_code' => $discountTotal > 0 ? $coupon->code : null,
                'subtotal' => $total,
                'discount_total' => $discountTotal,
                'total' => $finalTotal,
                'status' => 'pendiente',
            ]);

            foreach ($cart->items as $item) {
                $unitPrice = $item->product->finalPrice();
                $subtotal = $unitPrice * $item->quantity;

                $order->items()->create([
                    'product_id' => $item->product_id,
                    'commerce_id' => $item->product->commerce_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();
            session()->forget('cart_coupon_id');

            if ($discountTotal > 0) {
                $coupon->increment('used_count');
            }

            return $order;
        });

        return redirect()
            ->route('marketplace.orders.show', $order)
            ->with('success', 'Pedido creado correctamente.');
    }
}
