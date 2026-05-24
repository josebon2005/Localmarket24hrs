<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $coupons = Coupon::query()
            ->when($search, function ($query, $search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($status, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.coupons.index', compact('coupons', 'search', 'status'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        Coupon::create($this->validatedData($request));

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Cupón creado correctamente.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update($this->validatedData($request, $coupon));

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Cupón actualizado correctamente.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Cupón eliminado correctamente.');
    }

    public function toggleStatus(Coupon $coupon)
    {
        $coupon->update([
            'status' => $coupon->status === 'activo' ? 'inactivo' : 'activo',
        ]);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Estado del cupón actualizado.');
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
