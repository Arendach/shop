<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Cart\ChangeAmountRequest;
use App\Services\CartService;

class CartController extends CatalogController
{
    public function index(CartService $cartService)
    {
        $data = [
            'title'       => __('cart.title'),
            'breadcrumbs' => [[__('cart.title')]],
            'cart'        => $cartService->get()
        ];

        return view('catalog.pages.cart', $data);
    }

    public function action_attach(int $id, int $quantity, CartService $cartService)
    {
        $cartService->attach($id, $quantity);

        return response()->json([
            'title'            => translate('Виконано'),
            'message'          => translate('Товар вдало доданий в корзину'),
            'productsListHtml' => $cartService->getProductsListHtml(),
            'cartSumProducts'  => number_format($cartService->getProductsSum()),
            'cartContProducts' => $cartService->countProducts()
        ]);
    }

    public function action_attach_detail(array $data, CartService $cartService)
    {
        $data = json_decode(json_encode($data));
        $data_attribute = [];
        $quantity = 1;
        $id = null;
        foreach ($data as $value) {
            if ($value->name == 'product_id' && $value->value != '0')
                $id = $value->value;
            if ($value->name == 'attributes')
                $data_attribute[] = $value->value;
            if ($value->name == 'quantity' && $value->value != '0')
                $quantity = $value->value;
        }

        $cartService->attach_detail($id, $data_attribute, $quantity);

        return response()->json([
            'title'            => translate('Виконано'),
            'message'          => translate('Товар вдало доданий в корзину'),
            'productsListHtml' => $cartService->getProductsListHtml(),
            'cartSumProducts'  => number_format($cartService->getProductsSum()),
            'cartContProducts' => $cartService->countProducts()
        ]);
    }

    public function action_change_amount(ChangeAmountRequest $request, CartService $cartService)
    {
        $result = $cartService->change_amount($request->id, $request->amount);

        if ($result)
            return response()->json([
                'cart_products_count' => $cartService->countProducts(),
                'cart_products_sum'   => number_format($cartService->getProductsSum(), 2)
            ], 200);
        else
            return response()->json([
                'title'               => __('cart.product_not_change_amount_title'),
                'message'             => __('cart.product_not_change_amount_message'),
                'cart_products_count' => $cartService->countProducts(),
                'cart_products_sum'   => number_format($cartService->getProductsSum(), 2)
            ], 500);
    }

    public function action_detach(int $id, CartService $cartService)
    {
        $cartService->detach($id);

        return response()->json([
            'title'            => translate('Виконано'),
            'message'          => translate('Товар видалений з корзини'),
            'productsListHtml' => $cartService->getProductsListHtml(),
            'cartSumProducts'  => number_format($cartService->getProductsSum()),
            'cartContProducts' => $cartService->countProducts()
        ]);
    }

    public function action_change_amount_up(CartService $cartService, $id, $amount)
    {
        $result = $cartService->change_amount($id, $amount);
        return response()->json([
            'title'             => translate('Виконано'),
            'message'           => translate('Кількість товару змінено'),
            'cartSumOneProduct' => "<strong>{$cartService->getProductOneSum($id, intval($amount))}</strong>",
            'cartSumProduct'    => $cartService->getProductsSum()
        ], 200);
    }

    public function action_detach_product(int $id, CartService $cartService)
    {
        $cartService->detach($id);

        return response()->json([
            'title'            => translate('Виконано'),
            'message'          => translate('Товар видалений з корзини'),
            'productsListHtml' => $cartService->getProductsListHtml(),
            'cartSumProducts'  => $cartService->getProductsSum()
        ]);
    }

}
