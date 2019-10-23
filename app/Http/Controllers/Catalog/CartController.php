<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Requests\Catalog\Cart\ChangeAmountRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends CatalogController
{
    public function index(CartService $cartService)
    {
        $data = [
            'title' => __('cart.title'),
            'breadcrumbs' => [[__('cart.title')]],
            'cart' => $cartService->get()
        ];

        return view('catalog.pages.cart', $data);
    }

    public function action_add(Request $request, CartService $cartService)
    {
        $result = $cartService->add($request->id);

        if ($result)
            return response()->json([
                'title' => __('cart.product_added_title'),
                'message' => __('cart.product_added_message'),
                'cart_products_count' => $cartService->countProducts()
            ], 200);
        else
            return response()->json([
                'title' => __('cart.product_not_added_title'),
                'message' => __('cart.product_not_added_message'),
                'cart_products_count' => $cartService->countProducts()
            ], 500);
    }

    public function action_change_amount(ChangeAmountRequest $request, CartService $cartService)
    {
        $result = $cartService->change_amount($request->id, $request->amount);

        if ($result)
            return response()->json([
                'cart_products_count' => $cartService->countProducts(),
                'cart_products_sum' => number_format($cartService->getProductsSum(), 2)
            ], 200);
        else
            return response()->json([
                'title' => __('cart.product_not_change_amount_title'),
                'message' => __('cart.product_not_change_amount_message'),
                'cart_products_count' => $cartService->countProducts(),
                'cart_products_sum' => number_format($cartService->getProductsSum(), 2)
            ], 500);
    }

    public function action_remove(Request $request, CartService $cartService)
    {
        $cartService->remove($request->id);

        return response()->json([
            'title' => __('cart.product_deleted_title'),
            'message' => __('cart.product_deleted_message'),
            'cart_products_count' => $cartService->countProducts(),
            'cart_products_sum' => number_format($cartService->getProductsSum(), 2)
        ], 200);
    }

}
