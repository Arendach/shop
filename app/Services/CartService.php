<?php

namespace App\Services;

use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartService
{
    private $session_id = '';

    /** @var Cart */
    private $cart;

    private $count_products = 0;

    private $products = [];

    public function __construct(Request $request)
    {
        if (is_null($request->getSession())) return;

        $this->session_id = $request->getSession()->getId() ?? '';

        $this->boot();
    }

    private function boot(): void
    {
        if (isAuth()) {
            $this->cart = Cart::where('user_id', customer()->id)
                ->with('products')
                ->latest()->first();
        } else {
            $this->cart = Cart::where('session', $this->session_id)
                ->with('products')
                ->latest()->first();
        }

        $this->count_products = is_null($this->cart) ? 0 : $this->cart->products->count();
    }

    /** Отримати обєкт корзини, створити якщо не існує */
    private function getOrCreate(): Cart
    {
        if (is_null($this->cart)) {
            $this->cart = new Cart;

            $this->cart->user_id = isAuth() ? customer()->id : null;
            $this->cart->session = $this->session_id;

            $this->cart->save();
        }

        return $this->cart;
    }

    /**
     * Получити корзину
     *
     * @return Cart|null
     */
    public function get()
    {
        return $this->cart;
    }

    // Додати товар до корзини
    public function attach(int $product_id): void
    {
        $cart = $this->getOrCreate();

        if ($cart->products->where('id', $product_id)->count()) {
            $cart->products->where('id', $product_id)->privot->increment('amount');
        } else {
            $cart->products()->attach($product_id);
        }

        $this->boot();
    }

    /**
     * Оновити кількість товару у корзині
     *
     * @param int $id
     * @param int $amount
     * @return bool
     */
    public function change_amount(int $id, int $amount): bool
    {
        $result = CartProduct::where('cart_id', $this->cart->id)
            ->where('id', $id)
            ->firstOrFail()
            ->update(['amount' => $amount]);

        $this->boot();

        return $result;
    }

    /**
     * Видалити корзину
     *
     * @param $id
     */
    public function remove($id): void
    {
        CartProduct::destroy($id);

        $this->boot();
    }

    public function detach(int $product_id): void
    {
        if ($this->cartIsSet()) {
            $this->cart->products()->detach($product_id);
        }
    }

    /**
     * Сума по товарах у корзині
     *
     * @return float
     */
    public function getProductsSum(): float
    {
        if (!$this->productsIsSet()) return 0;

        return $this->cart->products->sum(function ($product) {
            return $product->getOriginal('price') * $product->pivot->amount;
        });
    }

    /**
     * Маса товарів у корзині
     *
     * @return float
     */
    public function getProductsWeight(): float
    {
        if (!$this->productsIsSet()) return 0;

        return (float)$this->cart->products->sum(function ($cart_product) {
            return $cart_product->product->getOriginal('weight') * $cart_product->amount;
        });
    }

    public function importProductsFromSession(): void
    {
        // якщо користувач автентифікований
        if (isAuth()) {

            // получаємо найновішу корзину відповідно сесії
            $cart = Cart::where('session', $this->session_id)->latest()->first();

            // якщо вона існує то привязуємо до неї користувача
            if (!is_null($cart)) {
                $cart->user_id = customer()->id;

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

    /**
     * @param int $product_id
     * @return bool
     */
    public function hasProduct(int $product_id): bool
    {
        if (is_null($this->cart)) return false;

        if (is_null($this->cart->products)) return false;

        return in_array($product_id, $this->cart->products->pluck('product_id')->toArray());
    }

    private function cartIsSet(): bool
    {
        return !is_null($this->cart);
    }

    private function productsIsSet(): bool
    {
        if (!$this->cartIsSet()) return false;

        return !is_null($this->cart->products);
    }

    public function getProducts()
    {
        return $this->cart->products ?? [];
    }

    public function hasProducts(): bool
    {
        return count($this->cart->products ?? []);
    }

    public function countProducts(): int
    {
        return count($this->cart->products ?? []);
    }
}