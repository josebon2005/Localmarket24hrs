<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();

        $cart->load('items.product.commerce');

        return view('marketplace.cart.index', compact('cart'));
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

        return redirect()
            ->route('marketplace.cart.index')
            ->with('success', 'Carrito vaciado correctamente.');
    }

    private function getCart(): Cart
    {
        return Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);
    }
}
