<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Order\CheckoutRequest;
use App\Jobs\Emails\OrderEmailJob;
use App\Models\Order;
use App\Models\Price;
use App\Models\Streets;
use App\Services\CartService;
use App\Services\NewPostService;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\StreamTele\Sms\Auth;

class OrderController extends CatalogController
{
    public function checkout(CartService $cartService)
    {
        if ($cartService->isEmpty()) {
            return redirect(route('index'));
        }
        return view('catalog.pages.checkout');
    }

    public function create(CheckoutRequest $request)
    {
        $order = app(OrderService::class)->createOrder($request->validated());
        dispatch(new OrderEmailJob($order));
        $res = app(Auth::class)->smsSend($order->phone, $order->id);

        return response()->json([
            'orderId' => $order->id
        ]);
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

    public function actionNewPostPrice(Request $request): JsonResponse
    {
        $deliveryPrice = app(NewPostService::class)->calculatePrice([
            'city'   => $request->city,
            'weight' => $request->weight,
            'price'  => $request->price
        ]);

        return response()->json([
            'price' => $deliveryPrice
        ]);
    }
}