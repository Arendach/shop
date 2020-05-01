<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

class OrderService
{
    private $cartService;
    private $deliveryService;

    public function __construct(CartService $cartService, DeliveryService $deliveryService)
    {
        $this->cartService = $cartService;
        $this->deliveryService = $deliveryService;
    }

    public function create($request): Order
    {
        $order = Order::create(array_merge($request->all(), [
            'customer_id' => customer()->id,
            'name'        => implode(' ', [$request->first_name, $request->last_name])
        ]));

        $products = $this->cartService->getProducts()->mapWithKeys(function (Product $product) {
            return [
                $product->id => [
                    'price'  => $product->price,
                    'amount' => $product->pivot->amount
                ]
            ];
        });

        $order->products()->attach($products->toArray());

        $this->deliveryService->write($request, $order);

        $this->cartService->cleanCart();

        return $order;
    }
}