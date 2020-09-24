<?php

namespace App\Services;

use App\Http\Requests\Catalog\User\RegisterRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Exception;
use Auth;

class CustomerService
{
    private $request;

    private $user;

    private $desire_products;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->boot($request);
    }

    private function boot(Request $request): void
    {

    }

    public function register(array $data): Customer
    {
        $data = collect($data);

        if (!$data->has(['first_name', 'last_name', 'email', 'password', 'phone'])) {
            throw new Exception('Реєстрація неможлива! Не заповнені всі поля!', 500);
        }

        return Customer::create($data->all());
    }

    public function userExists(string $login): bool
    {
        return Customer::where('phone', $login)
            ->orWhere('email', $login)
            ->count();
    }

    public function userIsValid(string $login, string $password): bool
    {
        $user = Customer::where('phone', $login)
            ->orWhere('email', $login)
            ->first();

        if (is_null($user)) {
            return false;
        }

        return $user->password == md5($password);
    }

    public function get(string $login)
    {
        if (!is_null($this->user)) return $this->user;

        $user = Customer::where('phone', $login)
            ->orWhere('email', $login)
            ->first();

        return $user;
    }

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

    public function updateContacts(array $data): void
    {
        customer()->update($data);
    }

    public function updatePassword(array $data): void
    {
        customer()->update([
            'password' => md5(md5($data['password']))
        ]);
    }

    public function getCustomer(): ?array
    {
        if (!isAuth()) {
            return null;
        }

        $resource = new CustomerResource(customer());

        return $resource->toArray(request());
    }
}