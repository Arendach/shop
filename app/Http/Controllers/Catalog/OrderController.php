<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Order\CheckoutRequest;
use App\Jobs\Emails\OrderEmailJob;
use App\Models\Order;
use App\Services\AuthService;
use App\Services\CartService;
use App\Services\CustomerService;
use App\Services\NewPostService;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        dd($request->all());

        if (!isAuth() && $request->has('password')) {
            $customer = app(CustomerService::class)->register(
                $request->only('first_name', 'last_name', 'phone', 'password', 'email')
            );

            app(AuthService::class)->make($customer);
        }

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