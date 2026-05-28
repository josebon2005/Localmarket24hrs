<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RepartidorController extends Controller
{
    public function index()
    {
        $repartidores = User::where('role', 'repartidor')
            ->withCount([
                'deliveries as total_entregas',
                'deliveries as entregas_activas' => fn ($q) => $q->whereIn('status', ['confirmado', 'en_preparacion', 'en_camino']),
            ])
            ->orderBy('name')
            ->get();

        return view('admin.repartidores.index', [
            'repartidores' => $repartidores,
            'total'        => $repartidores->count(),
            'activos'      => $repartidores->where('status', 'activo')->count(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required'      => 'El nombre es obligatorio.',
            'email.required'     => 'El correo es obligatorio.',
            'email.email'        => 'Ingresa un correo válido.',
            'email.unique'       => 'Este correo ya está registrado.',
            'password.required'  => 'La contraseña es obligatoria.',
            'password.confirmed' => 'La confirmación no coincide.',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'repartidor',
            'status'   => 'activo',
        ]);

        return redirect()
            ->route('admin.repartidores.index')
            ->with('success', 'Repartidor registrado correctamente.');
    }

    public function toggleStatus(User $user)
    {
        if ($user->role !== 'repartidor') {
            abort(403);
        }

        $user->update([
            'status' => $user->status === 'activo' ? 'inactivo' : 'activo',
        ]);

        return back()->with('success', 'Estado del repartidor actualizado.');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'repartidor') {
            abort(403);
        }

        $user->deliveries()->update(['repartidor_id' => null]);
        $user->delete();

        return back()->with('success', 'Repartidor eliminado correctamente.');
    }
}
