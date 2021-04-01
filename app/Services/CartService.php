<?php

namespace App\Services;

use App\Models\CartProduct;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Collection;

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
            $this->cart = Cart::where('customer_id', customer()->id)
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

            $this->cart->customer_id = isAuth() ? customer()->id : null;
            $this->cart->session = $this->session_id;

            $this->cart->save();
        }

        return $this->cart;
    }

    /** Получити корзину */
    public function get()
    {
        return $this->cart;
    }

    public function isEmpty(): bool
    {
        return is_null($this->cart);
    }

    // Додати товар до корзини
    public function attach(int $product_id, int $quantity): void
    {
        $cart = $this->getOrCreate();
        $this_product_cart = CartProduct::where('cart_id', $cart->id)->where('product_id', $product_id)->whereNull('attributes');
        if ($this_product_cart->count()) {
            $quantity = $this_product_cart->first()->amount + $quantity;
            $this_product_cart->first()->update(['amount' => $quantity]);
            $this_product_cart->first()->save();
        } else {
            $cart->products()->attach($product_id, ['amount' => $quantity]);
        }

        $this->boot();
    }

    // Додати товар до корзини із деталей продукта
    public function attach_detail(int $product_id, array $attribute, int $quantity): void
    {
        $cart = $this->getOrCreate();
        $attributes = implode(',', $attribute);
        $attributes_array = explode(',', $attributes);
        $this_product_cart = CartProduct::where('cart_id', $cart->id)->where('product_id', $product_id)->where('attributes', $attributes);
        if ($this_product_cart->count()) {
            $quantity = $this_product_cart->first()->amount + $quantity;
            $this_product_cart->first()->update(['amount' => $quantity]);
            $this_product_cart->first()->save();
        } else {
            $cart->products()->attach($product_id, ['amount' => $quantity, 'attributes' => $attributes]);
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
        $result = CartProduct::where('id', $id)
            ->firstOrFail()
            ->update(['amount' => $amount]);

        $this->boot();

        return $result;
    }

    /** Видалити корзину */
    public function remove($id): void
    {
        CartProduct::destroy($id);

        $this->boot();
    }

    /** Видалити товар з корзини */
    public function detach(int $product_id): void
    {
        if ($this->cartIsSet()) {
            $this->cart->cartProduct()->where('id', $product_id)->first()->delete();
        }
    }

    /** Сума по товарах у корзині */
    public function getProductsSum(): float
    {
        if (!$this->productsIsSet()) return 0;

        return $this->cart->products->sum(function (Product $product) {
            return $product->new_price * $product->pivot->amount;
        });
    }

    public function getProductOneSum($id, $amount)
    {
        $product_id = $this->getProductsCart()->where('id', $id)->first()->product_id;
        $product = Product::where('id', $product_id)->firstOrFail();
        return $product->new_price * $amount;
    }

    /** Маса товарів у корзині */
    public function getProductsWeight(): float
    {
        if (!$this->productsIsSet()) return 0;

        return (float)$this->cart->products->sum(function ($cart_product) {
            return $cart_product->product->getOriginal('weight') * $cart_product->amount;
        });
    }

    /** Список товарів для випадаючого меню */
    public function getProductsListHtml(): string
    {
        $result = '';
        $this->cart->products()->get()->each(function (Product $product) use (&$result) {
            $result .= view('catalog.parts.dropdown-cart-product', ['cart' => $product])->render();
        });

        return $result;
    }

    /** Вартість доставки */
    public function getDeliverySum(): float
    {
        return 0;
    }

    public function importProductsFromSession(Customer $customer): void
    {
        // получаємо найновішу корзину відповідно сесії
        $cart = $this->cart;

        // якщо вона існує то привязуємо до неї користувача
        if (!is_null($cart)) {
            $cart->customer_id = $customer->id;

            $cart->save();
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
        return $this->cart->products ?? new Collection([]);
    }

    public function getProductsCart()
    {
        return $this->cart->cartProduct ?? new Collection([]);
    }

    public function hasProducts(): bool
    {
        return count($this->cart->products ?? []);
    }

    public function countProducts(): int
    {
        if (!$this->cart) {
            return 0;
        }

        return count($this->cart->products()->get() ?? []);
    }

    public function getProductsArray(): array
    {
        $products = $this->getProducts();

        $result = [];
        foreach ($products as $product) {
            $result[] = [
                'id'     => $product->id,
                'name'   => $product->name,
                'price'  => $product->new_price,
                'amount' => $product->pivot->amount,
                'weight' => $product->weight
            ];
        }

        return $result;
    }

    public function getAttributeList($id)
    {
        $attributes = $this->cart->cartProduct()->where('id', $id)->first()->attributes;
        $attributes_array_list = explode(',', $attributes);
        $collect_attributes = [];
        foreach ($attributes_array_list as $oneAttribute){
             $old_attr = ProductAttribute::with('attribute')->where('id',$oneAttribute)->first();
            $collect_attributes[$old_attr->attribute->name] = $old_attr->value;
        }
        return count($attributes_array_list) ? $collect_attributes : [];

    }
}