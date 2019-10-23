<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Menu;
use Closure;

class LoadCategories
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
        view()->share('categories', Category::where('parent_id', 0)->with('child')->get());
        view()->share('menu', Menu::with('items')->orderBy('sort')->get());

        return $next($request);
    }
}
