<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        // Vérifier si le jeton est valide
        if (!$this->isValidToken($token)) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }

    protected function isValidToken($token)
    {
        // Vérifier si le jeton est présent et valide
        // ...

        return true;
    }
}