<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRolePermission
{
    public function handle($request, Closure $next)
    {
        /*if (Auth::check() && Auth::user()->hasPermissionsTo('Gérer Rôles')) {
            return $next($request);
        }

        abort(403, 'Vous n\'avez pas la permission de gérer les rôles.');*/
    }
}
