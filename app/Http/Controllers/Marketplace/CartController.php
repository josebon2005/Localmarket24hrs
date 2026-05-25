<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();

        $cart->load('items.product.commerce');
        $subtotal = $cart->total();
        $coupon = Coupon::find(session('cart_coupon_id'));
        $discountTotal = 0;
        $couponSubtotal = $coupon ? $coupon->applicableSubtotal($cart->items) : 0;

        if ($coupon && $coupon->isAvailableFor($couponSubtotal)) {
            $discountTotal = $coupon->discountFor($couponSubtotal);
        } else {
            session()->forget('cart_coupon_id');
            $coupon = null;
        }

        $commerceIds = $cart->items
            ->pluck('product.commerce_id')
            ->filter()
            ->unique()
            ->values();

        $availableCoupons = Coupon::with('commerce')
            ->where('status', 'activo')
            ->where(function ($query) use ($commerceIds) {
                $query->whereNull('commerce_id')
                    ->orWhereIn('commerce_id', $commerceIds);
            })
            ->orderBy('minimum_total')
            ->orderByDesc('value')
            ->get()
            ->filter(function (Coupon $availableCoupon) use ($cart) {
                return $availableCoupon->isAvailableFor($availableCoupon->applicableSubtotal($cart->items));
            });

        return view('marketplace.cart.index', compact('cart', 'coupon', 'discountTotal', 'availableCoupons'));
    }

    public function add(Product $product)
    {
        if ($product->status !== 'activo' || $product->stock <= 0 || $product->commerce->status !== 'activo') {
            return redirect()
                ->back()
                ->with('error', 'Este producto no está disponible.');
        }

        $cart = $this->getCart();

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            if ($item->quantity + 1 > $product->stock) {
                return redirect()
                    ->back()
                    ->with('error', 'No hay suficiente stock disponible.');
            }

            $item->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()
            ->route('marketplace.cart.index')
            ->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $cart = $this->getCart();

        if ($cartItem->cart_id !== $cart->id) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($validated['quantity'] > $cartItem->product->stock) {
            return redirect()
                ->back()
                ->with('error', 'No hay suficiente stock disponible.');
        }

        $cartItem->update([
            'quantity' => $validated['quantity'],
        ]);

        return redirect()
            ->route('marketplace.cart.index')
            ->with('success', 'Cantidad actualizada.');
    }

    public function destroy(CartItem $cartItem)
    {
        $cart = $this->getCart();

        if ($cartItem->cart_id !== $cart->id) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()
            ->route('marketplace.cart.index')
            ->with('success', 'Producto eliminado del carrito.');
    }

    public function clear()
    {
        $cart = $this->getCart();

        $cart->items()->delete();
        session()->forget('cart_coupon_id');

        return redirect()
            ->route('marketplace.cart.index')
            ->with('success', 'Carrito vaciado correctamente.');
    }

    public function applyCoupon(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:40'],
        ]);

        $cart = $this->getCart();
        $cart->load('items.product.commerce');

        $coupon = Coupon::where('code', strtoupper(trim($validated['code'])))->first();
        $couponSubtotal = $coupon ? $coupon->applicableSubtotal($cart->items) : 0;

        if (!$coupon || !$coupon->isAvailableFor($couponSubtotal)) {
            return redirect()
                ->route('marketplace.cart.index')
                ->with('error', 'El cupón no existe, venció o no aplica para este carrito.');
        }

        session(['cart_coupon_id' => $coupon->id]);

        return redirect()
            ->route('marketplace.cart.index')
            ->with('success', 'Cupón aplicado correctamente.');
    }

    public function removeCoupon()
    {
        session()->forget('cart_coupon_id');

        return redirect()
            ->route('marketplace.cart.index')
            ->with('success', 'Cupón removido del carrito.');
    }

    private function getCart(): Cart
    {
        return Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);
    }
}
