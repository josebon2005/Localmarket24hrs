<?php

namespace App\Http\Controllers\Comerciante;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $commerce = auth()->user()->commerce;

        if (!$commerce) {
            return redirect()
                ->route('comerciante.commerce.create')
                ->with('error', 'Primero debes crear tu comercio.');
        }

        $orders = Order::whereHas('items', function ($query) use ($commerce) {
            $query->where('commerce_id', $commerce->id);
        })
            ->with([
                'user',
                'items' => function ($query) use ($commerce) {
                    $query->where('commerce_id', $commerce->id)
                        ->with(['product', 'commerce']);
                },
            ])
            ->latest()
            ->paginate(10);

        return view('comerciante.orders.index', compact('commerce', 'orders'));
    }

    public function show(Order $order)
    {
        $commerce = auth()->user()->commerce;

        if (!$commerce) {
            return redirect()
                ->route('comerciante.commerce.create')
                ->with('error', 'Primero debes crear tu comercio.');
        }

        $belongsToCommerce = $order->items()
            ->where('commerce_id', $commerce->id)
            ->exists();

        if (!$belongsToCommerce) {
            abort(403, 'No tienes permiso para ver este pedido.');
        }

        $order->load([
            'user',
            'items' => function ($query) use ($commerce) {
                $query->where('commerce_id', $commerce->id)
                    ->with(['product', 'commerce']);
            },
        ]);

        return view('comerciante.orders.show', compact('commerce', 'order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $commerce = auth()->user()->commerce;

        if (!$commerce) {
            return redirect()
                ->route('comerciante.commerce.create')
                ->with('error', 'Primero debes crear tu comercio.');
        }

        $belongsToCommerce = $order->items()
            ->where('commerce_id', $commerce->id)
            ->exists();

        if (!$belongsToCommerce) {
            abort(403, 'No tienes permiso para actualizar este pedido.');
        }

        $validated = $request->validate([
            'status' => ['required', 'in:pendiente,confirmado,en_preparacion,en_camino,entregado,cancelado'],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('comerciante.orders.show', $order)
            ->with('success', 'Estado del pedido actualizado correctamente.');
    }
}
