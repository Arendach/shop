<?php

namespace App\Services;

use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartService
{
    /**
     * @var string
     */
    private $session_id = '';

    /**
     * @var null|Cart
     */
    private $cart;

    /**
     * @var int
     */
    private $count_products = 0;

    public function __construct(Request $request)
    {
        if (is_null($request->getSession())) return null;

        $this->session_id = $request->getSession()->getId() ?? '';

        $this->boot();
    }

    private function boot(): void
    {
        if (is_auth()) {
            $this->cart = Cart::where('user_id', user()->id)
                ->with('products')
                ->latest()->first();
        } else {
            $this->cart = Cart::where('session', $this->session_id)
                ->with('products')
                ->latest()->first();
        }

        $this->count_products = is_null($this->cart) ? 0 : $this->cart->products->count();
    }

    private function getOrCreate(): Cart
    {
        if (is_null($this->cart)) {
            $this->cart = new Cart;

            $this->cart->user_id = is_auth() ? user()->id : null;
            $this->cart->session = $this->session_id;

            $this->cart->save();
        }

        return $this->cart;
    }

    private function setCartProduct(array $data): bool
    {
        if (CartProduct::where('cart_id', $data['cart_id'])->where('product_id', $data['product_id'])->count())
            return CartProduct::where('cart_id', $data['cart_id'])->where('product_id', $data['product_id'])->increment('amount');
        else
            return CartProduct::insert($data);
    }

    public function get()
    {
        return $this->cart;
    }

    public function countProducts(): int
    {
        return $this->count_products;
    }

    public function add(int $product_id): bool
    {
        $cart = $this->getOrCreate();

        $result = $this->setCartProduct([
            'cart_id' => $cart->id,
            'product_id' => $product_id,
            'amount' => 1
        ]);

        $this->boot();

        return $result;
    }

    public function change_amount(int $id, int $amount): bool
    {
        $result = CartProduct::where('cart_id', $this->cart->id)
            ->where('id', $id)
            ->firstOrFail()
            ->update(['amount' => $amount]);

        $this->boot();

        return $result;
    }

    public function remove($id): void
    {
        CartProduct::destroy($id);

        $this->boot();
    }

    public function getProductsSum(): float
    {
        return (float)$this->cart->products->sum(function ($cart_product) {
            return $cart_product->product->getOriginal('price') * $cart_product->amount;
        });
    }

    public function getProductsWeight(): float
    {
        return (float)$this->cart->products->sum(function ($cart_product) {
            return $cart_product->product->getOriginal('weight') * $cart_product->amount;
        });
    }

    public function importProductsFromSession(): void
    {
        // якщо користувач автентифікований
        if (is_auth()) {

            // получаємо найновішу корзину відповідно сесії
            $cart = Cart::where('session', $this->session_id)->latest()->first();

            // якщо вона існує то привязуємо до неї користувача
            if (!is_null($cart)) {
                $cart->user_id = user()->id;

                $cart->save();
            }
        }

        // перезагружаємо корзину
        $this->boot();
    }

    public function cleanCart(): void
    {
        $this->cart->delete();
    }
}