<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliveryMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->status !== 'activo') {
            auth()->logout();

            return redirect()
                ->route('login')
                ->with('error', 'Tu cuenta esta baneada o inactiva.');
        }

        if (auth()->user()->role !== 'repartidor') {
            abort(403, 'No tienes permiso para acceder al panel de repartidor.');
        }

        return $next($request);
    }
}
