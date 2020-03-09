<?php

namespace App\Services;

use App\Http\Requests\Catalog\Order\CheckoutRequest;
use App\Http\Requests\Catalog\User\RegisterRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Auth;
use Hash;
use Illuminate\Support\Collection;

class CustomerService
{
    private $request;

    private $user;

    /**
     * @var Collection
     */
    private $desire_products;

    /**
     * CustomerService constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->boot($request);
    }

    /**
     * @param Request $request
     * @return void
     */
    private function boot(Request $request): void
    {

    }

    public function register(array $data): Customer
    {
        $data = collect($data);

        if (!$data->has(['first_name', 'last_name', 'email', 'password', 'phone']))
            throw new Exception('Реєстрація неможлива! Не заповнені всі поля!', 500);

        return Customer::create($data->all());
    }

    /**
     * @param string $login
     * @return bool
     */
    public function userExists(string $login): bool
    {
        return User::where('phone', $login)
            ->orWhere('email', $login)
            ->count();
    }

    public function userIsValid(string $login, string $password)
    {
        $user = User::where('phone', $login)
            ->orWhere('email', $login)
            ->first();

        if (is_null($user)) return false;

        $valid = Hash::check($password, $user->password);

        if ($valid) $this->user = $user;

        return $valid;
    }

    /**
     * @param string $login
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function get(string $login)
    {
        if (!is_null($this->user)) return $this->user;

        $user = User::where('phone', $login)
            ->orWhere('email', $login)
            ->first();

        return $user;
    }

    /**
     * @param $request CheckoutRequest
     * @throws Exception
     */
    public function makeLoginAfterCheckout($request)
    {
        if (!isAuth()) {

            // запускаємо валідацію даних для реєстрації
            app(RegisterRequest::class);

            // реєструємо
            $user = $this->register($request->only(['name', 'email', 'phone', 'password']));

            // Авторизуємо
            Auth::make($user, $request, true);
        }
    }

    public function hasDesireProduct(int $product_id): bool
    {
        if (!isAuth()) return false;

        if (is_null($this->desire_products))
            $this->desire_products = customer()->desire_products;

        return in_array($product_id, $this->desire_products->pluck('id')->toArray());
    }
}