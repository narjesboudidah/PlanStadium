<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminPermission
{
    public function handle(Request $request, Closure $next)
    {
       /* if (Auth::check() && Auth::user()->hasPermissionsTo('consulter_historique')) {
            return $next($request);
        }

        abort(403, 'Vous n\'avez pas la permission de consulter l\'historique.');*/
    }
}
