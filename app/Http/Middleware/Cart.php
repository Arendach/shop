<?php

namespace App\Http\Middleware;

use Closure;
use App\Facades\Cart as CartFacade;

class Cart
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        view()->share('cart', CartFacade::get());
        view()->share('cart_count_products', CartFacade::countProducts());

        return $next($request);
    }
}
