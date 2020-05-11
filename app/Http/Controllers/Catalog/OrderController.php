<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Order\CheckoutRequest;
use App\Jobs\Emails\OrderEmailJob;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;

class OrderController extends CatalogController
{
    public function checkout(CartService $cartService)
    {
        if ($cartService->isEmpty()) {
            return redirect(route('index'));
        }

        return view('catalog.pages.checkout');
    }

    public function create(CheckoutRequest $request, OrderService $orderService)
    {
        $order = $orderService->create($request);

        dispatch(new OrderEmailJob($order));

        return response()->json(['redirectLink' => route('checkout.success', $order->id)]);
    }

    public function action_order_type_form(string $form)
    {
        return view("catalog.checkout.{$form}-form");
    }

    public function success(int $id)
    {
        $order = Order::findOrFail($id);

        return view('catalog.pages.checkout-success', compact('order'));
    }
}