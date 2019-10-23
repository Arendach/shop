<?php

namespace App\Http\Middleware;

use Closure;

class AdminAccessDetect
{
    public function handle($request, Closure $next)
    {
        if (!is_admin()) abort(403);

        return $next($request);
    }
}
