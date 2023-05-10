<?php

namespace App\Http\Middleware;

use App\Models\Role;
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
        $user = $request->user();
        if($user->HasRole('Admin Federation')){
            return response($user->getAllPermissions(), 201);
        }
        else {
            return response("no", 203);
        }
        // if ($request->user()->HasRole("Admin Federation")) {
        //     return $next($request);
        // } else {
        //     return response([],403);
        // }
    }
}
