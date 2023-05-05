<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class AdminSte
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        if (! $user) {
            // L'utilisateur n'est pas connecté, il est redirigé vers une autre page
            return response('Unauthorized', 403);
        }

        // Récupérer l'utilisateur connecté et le mettre en cache
        $user = Cache::remember('user_' . Auth::id(), 300, function () use ($user) {
            return $user;
        });

        // Récupérer les rôles de l'utilisateur et les mettre en cache
        $roles = Cache::remember('roles_' . $user->id, 300, function () {
            return DB::table('roles')
                ->join('role_user_pivots', 'roles.id', '=', 'role_user_pivots.role_id')
                ->join('users', 'role_user_pivots.user_id', '=', 'users.id')
                ->where('role_user_pivots.user_id', Auth::id())
                ->pluck('roles.type');
        });

        // Vérifier si l'utilisateur a le rôle nécessaire pour accéder à la page
        if ($roles->contains('admin_ste')) {
            // L'utilisateur a le rôle admin, il peut accéder à la page
            return $next($request);
        } else {
            // L'utilisateur n'a pas le rôle nécessaire, il est redirigé vers une autre page
            return response('Unauthorized', 403);
        }
    }
}