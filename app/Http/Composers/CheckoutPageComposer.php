<?php

namespace App\Http\Composers;

use App\Services\CartService;
use App\Services\CustomerService;
use App\Services\DeliveryService;
use App\Services\PayService;
use Illuminate\View\View;
use App\Models\Price;
class CheckoutPageComposer
{
    public function compose(View $view)
    {
        $checkoutPageData = [
            'url'        => route('checkout.create'),
            'customer'   => app(CustomerService::class)->getCustomer(),
            'payMethods' => app(PayService::class)->getPayMethodNames(),
            'shops'      => app(DeliveryService::class)->getAllShops(),
            'products'   => app(CartService::class)->getProductsArray(),
            'prices'     => app(PayService::class)->getPriceOne(),
        ];

        $view->with(compact('checkoutPageData'));
    }
}