<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Si no está logueado o no tiene rol
        if (!$user || !$user->role) {
            abort(403, 'No autorizado');
        }

        // Validar rol permitido
        if (!in_array($user->role->name, $roles)) {
            abort(403, 'Acceso restringido');
        }

        return $next($request);
    }
}