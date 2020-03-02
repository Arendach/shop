<?php

namespace App\Services;

use Exception;
use App\Models\Customer;
use Illuminate\Http\Request;

class AuthService
{
    /* @var Customer */
    private $customer;

    private $valid = false;

    private $session;

    public function __construct(Request $request)
    {
        if ($request->hasCookie('session')) {
            $this->session = $request->cookie('session');
        }

        $this->boot($request);
    }

    private function boot(Request $request): void
    {
        if (!is_null($this->session)) {
            $customer = Customer::where('session', $this->session);

            if ($customer->count()) {
                $this->customer = $customer->first();
                $this->valid = true;
            }
        }

        $this->valid = false;
    }


    public function getCustomer(): Customer
    {
        if (is_null($this->customer)) {
            throw new Exception('Customer is not logged');
        }

        return $this->customer;
    }

    public function isAuth(): bool
    {
        return $this->valid;
    }

    public function make(Customer $customer): void
    {
        setcookie('session', $customer->session, time() + config('app.cookie_life'));
    }

    public function exit(): void
    {
        setcookie('session', '', time() - 3600 * 24 * 385, '/');
    }

}