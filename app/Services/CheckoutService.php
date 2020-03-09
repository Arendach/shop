<?php

namespace App\Services;

use App\Http\Requests\Catalog\Order\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use Nexmo\Network\Number\Request;
use Session;
use NewPost;
use User;
use Auth;
use Delivery;
use Cart;

class CheckoutService
{
    /**
     * @var int
     */
    private $step = 1;

    /**
     * @var array
     */
    private $fields = [];

    /**
     * CheckoutService constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * @return void
     */
    private function boot()
    {
        $this->fields = Session::get('checkout.fields', []);
        $this->step = Session::get('checkout.step', 1);
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param string $field
     * @return mixed
     */
    public function getField(string $field)
    {
        if (isset($this->fields[$field]))
            return $this->fields[$field];

        return '';
    }

    /**
     * @param string|array $field
     * @param mixed $value
     * @return void
     */
    public function setField($field, $value = null): void
    {
        if (is_array($field)) {
            foreach ($field as $key => $item) {
                $this->fields[$key] = $item;
            }
        } else {
            $this->fields[$field] = $value;
        }

        Session::put('checkout.fields', $this->fields);
    }

    /**
     * @param int $step
     * @return void
     */
    public function setStep(int $step): void
    {
        $this->step = $step;

        Session::put('checkout.step', $this->step);
    }

    /**
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }


    /**
     * @return void
     */
    public function endCheckout(): void
    {
        Session::put('checkout.fields', []);
        Session::put('checkout.step', 1);

        $this->boot();

        Cart::cleanCart();
    }

    /**
     * @param $name
     * @return string
     */
    public function __get($name): string
    {
        if (isset($this->fields[$name])) return $this->fields[$name];

        return '';
    }

    /**
     * @return bool
     */
    public function issetWarehouses(): bool
    {
        return isset($this->fields['sending_city_key']);
    }

    /**
     * @return string
     * @throws \Throwable
     */
    public function getWarehouses(): string
    {
        if (!isset($this->fields['sending_city_key']))
            return '';

        $warehouses = NewPost::getWarehouses($this->fields['sending_city_key']);

        return view('catalog.order.checkout.delivery.warehouse_list', compact('warehouses'))
            ->render();
    }

    /*public function checkUser(CheckoutRequest $request, array $errors = []): array
    {
        // якщо користувач зареєстрований
        if ($request->get('registered') == 1) {

            // якщо існує користувач з таким номером телефона
            if (User::userExists($request->get('phone'))) {

                // якщо пароль співпадає з введеним
                if (User::userIsValid($request->get('phone'), (string)$request->password)) {

                    // логінимо користувача
                    Auth::make(User::get($request->get('phone')), $request, true);

                    // якщо пароль не співпадає
                } else {
                    $errors['password'] = 'Невірний пароль!';
                }

                // якщо існує користувач з таким емейлон но не існує з таким телефоном
            } elseif (User::userExists($request->get('email'))) {

                // якщо пароль співпадає з введеним
                if (User::userIsValid($request->email, (string)$request->password)) {

                    // логінимо користувача
                    Auth::make(User::get($request->get('phone')), $request, true);

                    // якщо пароль не співпадає
                } else {
                    $errors['password'] = 'Невірний пароль!';
                }

                // якщо користувач не знайдений ні з телефоном ні з емейлом
            } else {
                $errors['login'] = 'Такий користувач не знайдений!';
            }

            // якщо користувач зареєстрований
        } else {

            // якщо паролі не співпадають
            if ($request->password != $request->password_confirmation) {

                $errors['password_confirmation'] = 'Паролі не співпадають!';

                // якщо користувач з таким телефоном уже існує
            } elseif (User::userExists($request->phone)) {
                $errors['phone'] = 'Користувач з таким телефоном вже зареєстрований!';

            } elseif (User::userExists($request->email)) {
                $errors['email'] = 'Користувач з таким email вже зареєстрований!';

                // якщо паролі співпадають
            } else {
                // реєструємо нового користувача
                $user = User::register($request->only(['email', 'phone', 'name', 'password']));

                // Логінимо
                Auth::make($user, $request, true);
            }

        }

        return $errors;
    }*/

    /**
     * @param $request CheckoutRequest
     * @return integer
     */
    public function checkoutOrder(CheckoutRequest $request): int
    {
        $order = $this->checkOrder($request);

        $order = $this->checkDelivery($request, $order);

        $order = $this->checkProducts($request, $order);

        $this->endCheckout();

        return (int)$order->id;
    }

    /**
     * @param $request CheckoutRequest
     * @return Order
     */
    private function checkOrder(CheckoutRequest $request): Order
    {
        $order = new Order;

        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->delivery = $request->delivery;
        $order->comment = $request->comment;
        $order->user_id = customer()->id;
        $order->status = 'new_order';
        $order->pay_method = $request->pay;

        $order->save();

        return $order;
    }

    /**
     * @param CheckoutRequest $request
     * @param Order $order
     * @return Order
     */
    private function checkDelivery(CheckoutRequest $request, Order $order): Order
    {
        $order = Delivery::write($request, $order);

        return $order;
    }

    private function checkProducts(CheckoutRequest $request, Order $order): Order
    {
        $products = Cart::get()->products;

        foreach ($products as $product) {
            $orderProduct = new OrderProduct;

            $orderProduct->product_id = $product->product_id;
            $orderProduct->order_id = $order->id;
            $orderProduct->amount = $product->amount;
            $orderProduct->price = $product->product->now_price;

            $orderProduct->save();
        }

        return $order;
    }
}