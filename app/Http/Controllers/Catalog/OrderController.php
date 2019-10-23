<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Order\CheckoutRequest;
use App\Services\DeliveryService;
use App\Services\PayService;
use Illuminate\Http\Request;
use Checkout;
use NewPost;
use Delivery;
use Pay;
use User;
use Cart;

class OrderController extends CatalogController
{
    public function checkout(PayService $payService, DeliveryService $deliveryService)
    {
        if (is_null(Cart::get()))
            return redirect(route('index'));

        $data = [
            'title' => __('order.checkout.title'),
            'breadcrumbs' => [
                [__('cart.title'), route('cart')],
                [__('order.checkout.title')]
            ],
            'order_types' => include base_path('assets/order_types.php')
        ];

        return view('catalog.order.checkout.main', $data);
    }

    public function action_checkout_input(Request $request)
    {
        if (isset($request->fields)) Checkout::setField($request->fields);
        else Checkout::setField($request->name, $request->value);
    }

    public function action_get_delivery_type(Request $request)
    {
        Checkout::setField('delivery', $request->type);

        return view("catalog.order.checkout.delivery.{$request->type}");
    }

    public function action_checkout(CheckoutRequest $request)
    {
        // валідація, авторизація|реєстрація користувача
        User::makeLoginAfterCheckout($request);

        // валідація форми доставки
        Delivery::validate($request);

        // валідація форми оплати
        Pay::validateCheckout($request);

        $id = Checkout::checkoutOrder($request);

        return response()->json([
            'success' => true,
            'message' => '',
            'redirectRoute' => route('profile.orders.view', $id)
        ]);
    }

    public function action_new_post_city_search(Request $request)
    {
        $city_list = NewPost::getCityList($request->city);

        $content = view('catalog.order.checkout.delivery.city_list', [
            'city_list' => $city_list
        ])->render();

        return response()->json([
            'content' => $content
        ], 200);
    }

    public function action_new_post_warehouse_search(Request $request)
    {
        Checkout::setField('sending_city', $request->sending_city);
        Checkout::setField('sending_city_key', $request->sending_city_key);

        $warehouses = NewPost::getWarehouses($request->sending_city_key);

        $content = view('catalog.order.checkout.delivery.warehouse_list', compact('warehouses'))
            ->render();

        return response()->json([
            'content' => $content
        ], 200);
    }
}
