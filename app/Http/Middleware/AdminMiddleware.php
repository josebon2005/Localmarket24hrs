<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Verifica que el usuario autenticado sea administrador y esté activo.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->status !== 'activo') {
            auth()->logout();

            return redirect()->route('login')
                ->with('error', 'Tu cuenta está baneada o inactiva.');
        }

        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder al panel administrativo.');
        }

        return $next($request);
    }
}
