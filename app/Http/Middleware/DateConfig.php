<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;

class DateConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Carbon::setLocale(config('locale.current'));

        return $next($request);
    }
}
