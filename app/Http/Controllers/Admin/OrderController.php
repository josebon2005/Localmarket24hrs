<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $orders = Order::with(['user', 'items.product.commerce', 'repartidor'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('id', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($u) use ($search) {
                            $u->where('name', 'like', "%{$search}%")
                              ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->when($status, fn ($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $counts = [
            'total'          => Order::count(),
            'pendiente'      => Order::where('status', 'pendiente')->count(),
            'confirmado'     => Order::where('status', 'confirmado')->count(),
            'en_preparacion' => Order::where('status', 'en_preparacion')->count(),
            'en_camino'      => Order::where('status', 'en_camino')->count(),
            'entregado'      => Order::where('status', 'entregado')->count(),
            'cancelado'      => Order::where('status', 'cancelado')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'search', 'status', 'counts'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product.commerce', 'repartidor']);

        $repartidores = User::where('role', 'repartidor')
            ->where('status', 'activo')
            ->orderBy('name')
            ->get();

        return view('admin.orders.show', compact('order', 'repartidores'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pendiente,confirmado,en_preparacion,en_camino,entregado,cancelado'],
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Estado del pedido actualizado correctamente.');
    }

    public function assignRepartidor(Request $request, Order $order)
    {
        $validated = $request->validate([
            'repartidor_id' => ['nullable', 'exists:users,id'],
        ]);

        $order->update(['repartidor_id' => $validated['repartidor_id'] ?: null]);

        $msg = $validated['repartidor_id']
            ? 'Repartidor asignado correctamente.'
            : 'Repartidor removido del pedido.';

        return back()->with('success', $msg);
    }

    public function dispatch(Request $request, Order $order)
    {
        $validated = $request->validate([
            'repartidor_id' => ['required', 'exists:users,id'],
        ], [
            'repartidor_id.required' => 'Debes seleccionar un repartidor.',
            'repartidor_id.exists'   => 'El repartidor seleccionado no es válido.',
        ]);

        $order->update([
            'status'        => 'en_camino',
            'repartidor_id' => $validated['repartidor_id'],
        ]);

        return back()->with('success', 'Pedido enviado y repartidor asignado correctamente.');
    }

    public function saveNote(Request $request, Order $order)
    {
        $validated = $request->validate([
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order->update(['admin_notes' => $validated['admin_notes'] ?? null]);

        return back()->with('success', 'Nota guardada correctamente.');
    }
}
