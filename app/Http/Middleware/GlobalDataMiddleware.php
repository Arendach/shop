<?php

namespace App\Http\Middleware;

use Closure;
use Cache;
use App\Models\Page;
use App\Models\Index;

class GlobalDataMiddleware
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
        $data = [
            'globalData'     => Cache::rememberForever('globalData', function () {
                return Index::where('is_main', true)->first();
            }),
            'fastNavigation' => Cache::rememberForever('fastNavigation', function () {
                return Page::where('is_fast_navigation', true)->get();
            })
        ];

        view()->share($data);

        return $next($request);
    }
}
