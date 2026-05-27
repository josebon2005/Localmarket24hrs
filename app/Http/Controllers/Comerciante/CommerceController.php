<?php

namespace App\Http\Controllers\Comerciante;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Commerce;
use Illuminate\Http\Request;

class CommerceController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if ($user->commerce) {
            return redirect()
                ->route('comerciante.dashboard')
                ->with('error', 'Ya tienes un comercio registrado.');
        }

        $categories = Category::where('status', 'activa')
            ->orderBy('name')
            ->get();

        return view('comerciante.commerce.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user->commerce) {
            return redirect()
                ->route('comerciante.dashboard')
                ->with('error', 'Ya tienes un comercio registrado.');
        }

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'category_id' => ['required', 'exists:categories,id'],
            'address'     => ['nullable', 'string', 'max:255'],
            'phone'       => ['nullable', 'string', 'max:30'],
            'logo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'name.required'       => 'El nombre del comercio es obligatorio.',
            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists'  => 'La categoría seleccionada no es válida.',
            'logo.image'          => 'El logo debe ser una imagen.',
            'logo.mimes'          => 'El logo debe ser JPG, PNG o WebP.',
            'logo.max'            => 'El logo no puede superar los 2 MB.',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Commerce::create([
            'user_id'     => $user->id,
            'category_id' => $validated['category_id'],
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'address'     => $validated['address'] ?? null,
            'phone'       => $validated['phone'] ?? null,
            'logo'        => $logoPath,
            'status'      => 'activo',
        ]);

        $user->update([
            'role' => 'comerciante',
        ]);

        return redirect()
            ->route('comerciante.dashboard')
            ->with('success', 'Tu comercio fue creado correctamente.');
    }
}
