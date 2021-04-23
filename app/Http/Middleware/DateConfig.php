<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;

class DateConfig
{
    public function handle($request, Closure $next)
    {
        Carbon::setLocale(config('locale.current'));

        return $next($request);
    }
}
