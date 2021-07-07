<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;

class OrderService
{
    private $cartService;
    private $deliveryService;
    private $customer;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->cartService = app(CartService::class);
        $this->deliveryService = $deliveryService;
        $this->customer = customer();
    }

    public function makeCustomerIfNotExists(array $data): void
    {
        $data = collect($data);

        if (!isAuth() && $data->has('password')) {
            $customer = app(CustomerService::class)->register(
                $data->only('first_name', 'last_name', 'phone', 'password', 'email')->toArray()
            );

            app(AuthService::class)->make($customer)->reboot();

            $this->customer = $customer;
        }
    }

    public function createOrder(array $data): Order
    {
        $this->makeCustomerIfNotExists($data);

        $data = collect($data);
        $order = Order::create(array_merge($data->all(), [
            'customer_id' => $this->customer->id,
            'name'        => implode(' ', [$data->get('first_name'), $data->get('last_name')])
        ]));
        $order->check_callback = $data->get('check_callback') == 'on' ? 1 : 0;
        $order->delivery_price = ($this->cartService->getProductsSum() < setting('Безкоштовна доставка від',1500)) ? intval($data->get('delivery_price')) : 0;

        $order->save();

        foreach ($this->cartService->getProductsCart() as $cart_product){
            $products = [];
            $products = [
                $cart_product->product->id => [
                'price'     => $cart_product->product->new_price,
                'amount'    => $cart_product->amount,
                'attribute' => $cart_product->attributes
            ]];
            $order->products()->attach($products);
        }

//        $products = $this->cartService->getProducts()->mapWithKeys(function (Product $product) {
//            return [
//                $product->id => [
//                    'price'  => $product->new_price,
//                    'amount' => $product->pivot->amount
//                ]
//            ];
//        });
//
//        $order->products()->attach($products->toArray());

        $this->cartService->cleanCart();

        return $order;
    }
}