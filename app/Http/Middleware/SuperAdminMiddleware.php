<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*if (! $request->user() || ! $request->user()->isSuperAdmin()) {
        abort(403, 'Unauthorized action.');
        }
        return $next($request);*/

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Récupérer l'utilisateur connecté et le mettre en cache
        $user = Cache::remember('user_' . Auth::id(), 300, function () use ($user) {
            return $user;
        });

        // Récupérer les rôles de l'utilisateur et les mettre en cache
        $roles = Cache::remember('roles_' . $user->id, 300, function () {
            return DB::table('roles')
                ->join('role_user_pivots', 'roles.id', '=', 'role_user_pivots.role_id')
                ->where('role_user_pivots.user_id', Auth::id())
                ->pluck('roles.type');
        });

        // Vérifier si l'utilisateur a le rôle nécessaire pour accéder à la page
        if ($roles->contains('superadmin')) {
            // L'utilisateur a le rôle admin, il peut accéder à la page
            return $next($request);
        } else {
            // L'utilisateur n'a pas le rôle nécessaire, il est redirigé vers une autre page
            return response('Unauthorized', 403);
        }
    }
}