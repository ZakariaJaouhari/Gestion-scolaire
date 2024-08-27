<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfNotDirecteur
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('directeur')->check()) {
            return redirect('/'); // Rediriger vers la page de login
        }

        return $next($request);
    }
}
