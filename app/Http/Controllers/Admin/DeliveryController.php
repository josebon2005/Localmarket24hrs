<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DeliveryController extends Controller
{
    public function index()
    {
        $repartidores = User::where('role', 'repartidor')
            ->latest()
            ->paginate(10);

        $orders = Order::with(['user', 'deliveryUser'])
            ->latest()
            ->paginate(10, ['*'], 'orders_page');

        $activeRepartidores = User::where('role', 'repartidor')
            ->where('status', 'activo')
            ->orderBy('name')
            ->get();

        return view('admin.delivery.index', compact('repartidores', 'orders', 'activeRepartidores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'repartidor',
            'status' => 'activo',
        ]);

        return redirect()
            ->route('admin.delivery.index')
            ->with('success', 'Repartidor creado correctamente.');
    }

    public function assign(Request $request, Order $order)
    {
        $validated = $request->validate([
            'delivery_user_id' => ['nullable', 'exists:users,id'],
        ]);

        $repartidorId = $validated['delivery_user_id'] ?? null;

        if ($repartidorId) {
            $repartidor = User::where('role', 'repartidor')
                ->where('status', 'activo')
                ->findOrFail($repartidorId);

            $order->update([
                'delivery_user_id' => $repartidor->id,
                'delivery_status' => $order->delivery_status === 'sin_asignar' ? 'asignado' : $order->delivery_status,
            ]);
        } else {
            $order->update([
                'delivery_user_id' => null,
                'delivery_status' => 'sin_asignar',
            ]);
        }

        return redirect()
            ->route('admin.delivery.index')
            ->with('success', 'Asignacion de repartidor actualizada.');
    }
}
