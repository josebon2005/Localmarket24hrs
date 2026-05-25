<?php

namespace App\Http\Controllers\Comerciante;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    public function index()
    {
        $commerce = $this->commerceOrRedirect();

        if (!$commerce) {
            return redirect()
                ->route('comerciante.commerce.create')
                ->with('error', 'Primero debes crear tu comercio.');
        }

        $coupons = $commerce->coupons()
            ->latest()
            ->paginate(10);

        return view('comerciante.coupons.index', compact('commerce', 'coupons'));
    }

    public function create()
    {
        $commerce = $this->commerceOrRedirect();

        if (!$commerce) {
            return redirect()
                ->route('comerciante.commerce.create')
                ->with('error', 'Primero debes crear tu comercio.');
        }

        return view('comerciante.coupons.create', compact('commerce'));
    }

    public function store(Request $request)
    {
        $commerce = $this->commerceOrRedirect();

        if (!$commerce) {
            return redirect()
                ->route('comerciante.commerce.create')
                ->with('error', 'Primero debes crear tu comercio.');
        }

        $commerce->coupons()->create($this->validatedData($request));

        return redirect()
            ->route('comerciante.coupons.index')
            ->with('success', 'Cupón creado correctamente.');
    }

    public function edit(Coupon $coupon)
    {
        $commerce = $this->commerceOrRedirect();

        if (!$commerce || $coupon->commerce_id !== $commerce->id) {
            abort(403, 'No tienes permiso para editar este cupón.');
        }

        return view('comerciante.coupons.edit', compact('commerce', 'coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $commerce = $this->commerceOrRedirect();

        if (!$commerce || $coupon->commerce_id !== $commerce->id) {
            abort(403, 'No tienes permiso para actualizar este cupón.');
        }

        $coupon->update($this->validatedData($request, $coupon));

        return redirect()
            ->route('comerciante.coupons.index')
            ->with('success', 'Cupón actualizado correctamente.');
    }

    public function destroy(Coupon $coupon)
    {
        $commerce = $this->commerceOrRedirect();

        if (!$commerce || $coupon->commerce_id !== $commerce->id) {
            abort(403, 'No tienes permiso para eliminar este cupón.');
        }

        $coupon->delete();

        return redirect()
            ->route('comerciante.coupons.index')
            ->with('success', 'Cupón eliminado correctamente.');
    }

    public function toggleStatus(Coupon $coupon)
    {
        $commerce = $this->commerceOrRedirect();

        if (!$commerce || $coupon->commerce_id !== $commerce->id) {
            abort(403, 'No tienes permiso para cambiar este cupón.');
        }

        $coupon->update([
            'status' => $coupon->status === 'activo' ? 'inactivo' : 'activo',
        ]);

        return redirect()
            ->route('comerciante.coupons.index')
            ->with('success', 'Estado del cupón actualizado.');
    }

    private function commerceOrRedirect()
    {
        return auth()->user()->commerce;
    }

    private function validatedData(Request $request, ?Coupon $coupon = null): array
    {
        $data = $request->validate([
            'code' => [
                'required',
                'string',
                'max:40',
                Rule::unique('coupons', 'code')->ignore($coupon),
            ],
            'description' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:percentage,fixed'],
            'value' => ['required', 'numeric', 'min:0.01'],
            'minimum_total' => ['nullable', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'status' => ['required', 'in:activo,inactivo'],
        ]);

        $data['code'] = strtoupper(trim($data['code']));
        $data['minimum_total'] = $data['minimum_total'] ?? 0;

        return $data;
    }
}
