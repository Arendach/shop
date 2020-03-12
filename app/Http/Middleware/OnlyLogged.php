<?php

namespace App\Http\Middleware;

use Closure;

class OnlyLogged
{
    public function handle($request, Closure $next)
    {
        if (!isAuth()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
