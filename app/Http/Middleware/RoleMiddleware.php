<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user()) {
            return response()->json([
                'message' => 'Utilisateur non authentifié',
            ], 401);
        }

        if ($request->user()->role->nom !== $role) {
            return response()->json([
                'message' => 'Accès interdit',
            ], 403);
        }

        return $next($request);
    }
}
