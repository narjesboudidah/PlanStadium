<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRolePermission
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user()->hasRole($role)) {
            return $next($request);
        }

        abort(403, 'Vous n\'avez pas la permission de gérer les rôles.');
    }
}
