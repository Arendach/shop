<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Cart\ChangeAmountRequest;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

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

    public function action_attach(int $id, CartService $cartService)
    {
        $cartService->attach($id);

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

}
