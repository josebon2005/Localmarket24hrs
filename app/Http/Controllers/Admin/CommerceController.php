<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commerce;
use Illuminate\Http\Request;

class CommerceController extends Controller
{
    /**
     * Muestra el listado de comercios registrados.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        $status = $request->input('status');

        $categories = Category::orderBy('name')->get();

        $commerces = Commerce::with(['user', 'category'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.commerces.index', compact(
            'commerces',
            'categories',
            'search',
            'categoryId',
            'status'
        ));
    }

    /**
     * Suspende un comercio.
     */
    public function suspend(Commerce $commerce)
    {
        $commerce->update([
            'status' => 'suspendido',
        ]);

        return redirect()
            ->route('admin.commerces.index')
            ->with('success', 'Comercio suspendido correctamente.');
    }

    /**
     * Reactiva un comercio suspendido o inactivo.
     */
    public function activate(Commerce $commerce)
    {
        $commerce->update([
            'status' => 'activo',
        ]);

        return redirect()
            ->route('admin.commerces.index')
            ->with('success', 'Comercio reactivado correctamente.');
    }

    /**
     * Marca un comercio como inactivo.
     */
    public function deactivate(Commerce $commerce)
    {
        $commerce->update([
            'status' => 'inactivo',
        ]);

        return redirect()
            ->route('admin.commerces.index')
            ->with('success', 'Comercio marcado como inactivo correctamente.');
    }

    /**
     * Elimina un comercio.
     */
    public function destroy(Commerce $commerce)
    {
        $commerce->delete();

        return redirect()
            ->route('admin.commerces.index')
            ->with('success', 'Comercio eliminado correctamente.');
    }
}
