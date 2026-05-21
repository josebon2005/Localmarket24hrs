<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commerce;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $categories = Category::where('status', 'activa')
            ->orderBy('name')
            ->get();

        $commerces = Commerce::with('category')
            ->where('status', 'activo')
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('marketplace.home', compact('categories', 'commerces', 'search', 'categoryId'));
    }

    public function show(Commerce $commerce)
    {
        if ($commerce->status !== 'activo') {
            abort(404);
        }

        $commerce->load(['category', 'user']);

        $products = $commerce->products()
            ->where('status', 'activo')
            ->latest()
            ->paginate(12);

        return view('marketplace.commerce-show', compact('commerce', 'products'));
    }
}
