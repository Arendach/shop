<?php

namespace App\Services;

use App\Http\Requests\Catalog\Order\CheckoutDeliveryRequest;
use App\Http\Requests\Catalog\Order\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderDelivery;
use App\Models\OrderSelf;
use App\Models\OrderSending;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use NewPost;
use Request;
use Cart;
use Throwable;
use Exception;

class DeliveryService
{
    /**
     * @var Collection
     */
    private $shops;

    /**
     * DeliveryService constructor.
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * Загрузка сервіса
     *
     * @return void
     */
    public function boot(): void
    {
        $this->shops = new Collection(asset_data('shops'));
    }

    /**
     * Валідація форми доставки при заведенні замовлення
     * @param $request
     * @return void
     * @throws ValidationException
     */
    public function validate($request): void
    {
        if ($request->delivery == 'delivery')
            $this->validateDelivery();
        elseif ($request->delivery == 'sending')
            $this->validateSending();
        elseif ($request->delivery == 'self')
            $this->validateSelf();
    }

    /**
     * @param CheckoutRequest $request
     * @param Order $order
     * @return Order
     */
    public function write(CheckoutRequest $request, Order $order): Order
    {
        if ($request->delivery == 'delivery')
            return $this->writeDelivery($request, $order);
        elseif ($request->delivery == 'sending')
            return $this->writeSending($request, $order);
        elseif ($request->delivery == 'self')
            return $this->writeSelf($request, $order);

        return $order;
    }

    /**
     * Назва магазину(для самовивозів)
     *
     * @param $shop_id
     * @return string
     */
    public function getSelfShopName($shop_id): string
    {
        if (!isset($this->shops[$shop_id]['name']))
            return '';

        return $this->shops[$shop_id]['name'];
    }

    /**
     * Адреса магазину(для самовивозів)
     *
     * @param $shop_id
     * @return mixed
     */
    public function getSelfShopAddress($shop_id): string
    {
        if (!isset($this->shops[$shop_id]['name']))
            return '';

        return $this->shops[$shop_id]['name'];
    }

    /**
     * @param int $shop_id
     * @return array
     * @throws Exception
     */
    public function getSelfShop(int $shop_id): array
    {
        if (!isset($this->shops[$shop_id]))
            throw new Exception('Такого магазину немає в базі!');

        return $this->shops[$shop_id];
    }

    /**
     * Форма доставки
     *
     * @return string
     * @throws Throwable
     */
    public function getDeliveryForm(): string
    {
        return view('catalog.order.checkout.delivery.delivery')
            ->render();
    }

    /**
     * Форма відправки
     *
     * @return string
     * @throws Throwable
     */
    public function getSendingForm(): string
    {
        return view('catalog.order.checkout.delivery.sending')
            ->render();
    }

    /**
     * Форма самовивозу
     *
     * @return string
     * @throws Throwable
     */
    public function getSelfForm(): string
    {
        return view('catalog.order.checkout.delivery.self')
            ->render();
    }


    /**
     * Валідація форми доставки по місту
     *
     * @return void
     */
    private function validateDelivery()
    {
        app(CheckoutDeliveryRequest::class);

        if (!is_null(Request::get('delivery_date')))
            if (strtotime(Request::get('delivery_date')) < strtotime(date('Y-m-d') . ' 00:00:00'))
                $errors['delivery_date'] = 'Дата не може бути минулою!';
    }

    /**
     * Валідація форми відправки при оформленні замовлення
     *
     * @return void
     */
    private function validateSending(): void
    {
        $errors = [];

        if (Request::get('sending_city_key') == '')
            $errors['sending_city'] = 'Виберіть ваше місто!';

        if (is_null(Request::get('sending_warehouse')))
            $errors['sending_warehouse'] = 'Виберіть ваше відділення!';

        if (config('app.post_products_weight_validate')) {
            $max_weight = NewPost::maxWeight((string)Request::get('sending_city_key'), (string)Request::get('sending_warehouse'));
            $products_weight = Cart::getProductsWeight();

            if ($max_weight != 0 && $products_weight > $max_weight)
                $errors['sending_warehouse'] = "Вага вибраних товарів({$products_weight}кг) перевищує вагу яку приймає відділення({$max_weight}кг). Виберіть інше відділення!";
        }

        if (count($errors))
            throw ValidationException::withMessages($errors);
    }

    /**
     * Валідація полів самовивоза (магазин, дата)
     *
     * @return void
     */
    private function validateSelf(): void
    {
        $errors = [];

        // якщо дата заповнена і заповнена заднім числом то помилка
        if (!is_null(Request::get('self_date')))
            if (strtotime(Request::get('self_date')) < strtotime(date('Y-m-d') . ' 00:00:00'))
                $errors['self_date'] = 'Дата не може бути минулою!';

        // якщо вибраний магазин не описаний у файлі assets/shops.php то помилка
        $shops = new Collection(asset_data('shops'));

        if (!$shops->where('base_id', Request::get('self_shop'))->count())
            $errors['self_shop'] = 'Виберіть магазин!';

        // якщо масив з помилками не порожній то кидаємо виключення
        if (count($errors) > 0)
            throw ValidationException::withMessages($errors);
    }

    /**
     * Запис в базу даних інформації по доставці по Києву
     *
     * @param CheckoutRequest $request
     * @param Order $order
     * @return Order
     */
    private function writeDelivery(CheckoutRequest $request, Order $order): Order
    {
        // таблиця з інформацією по доставці
        $delivery = new OrderDelivery;

        // Запис даних в таблицю
        $delivery->city = $request->delivery_city;
        $delivery->street = $request->delivery_street;
        $delivery->address = $request->delivery_address;
        $delivery->order_id = $order->id;

        // зберігаєм
        $delivery->save();

        // Записуємо дату доставки в замовлення
        $order->date_delivery = $request->delivery_date;

        // зберігаємо
        $order->save();

        // вертаємо модифіковане замовлення
        return $order;
    }

    /**
     * Запис в базу даних інформації по відправці Новою Поштою
     *
     * @param CheckoutRequest $request
     * @param Order $order
     * @return Order
     */
    private function writeSending(CheckoutRequest $request, Order $order): Order
    {
        $warehouse = NewPost::getWarehouseNameLocale($request->sending_city_key, $request->sending_warehouse);
        $city = NewPost::getCityNameLocale($request->sending_city_key);

        // таблиця з інформацією по доставці
        $sending = new OrderSending;

        // Запис даних в таблицю
        $sending->city_key = $request->sending_city_key;
        $sending->city_name_uk = $city['name_uk'];
        $sending->city_name_ru = $city['name_ru'];

        $sending->warehouse_key = $request->sending_warehouse;
        $sending->warehouse_name_uk = $warehouse['name_uk'];
        $sending->warehouse_name_ru = $warehouse['name_ru'];

        $sending->order_id = $order->id;

        // зберігаєм
        $sending->save();

        // вертаємо модифіковане замовлення
        return $order;
    }

    /**
     * Запис в базу даних інформації по самовивозу
     *
     * @param CheckoutRequest $request
     * @param Order $order
     * @return Order
     */
    private function writeSelf(CheckoutRequest $request, Order $order): Order
    {
        // таблиця з інформацією по відправці
        $self = new OrderSelf;

        // Запис даних в таблицю
        $self->shop = $request->self_shop;
        $self->order_id = $order->id;

        // зберігаєм
        $self->save();

        // Записуємо дату доставки в замовлення
        $order->date_delivery = $request->self_date;

        // зберігаємо
        $order->save();

        // вертаємо модифіковане замовлення
        return $order;
    }
}