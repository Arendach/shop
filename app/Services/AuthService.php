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
        if (isset($_COOKIE['customer_session'])) {
            $this->session = $_COOKIE['customer_session'];
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
                return;
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
        setcookie('customer_session', $customer->session, time() + 3600 * 24 * 385, '/');
    }

    public function logout(): void
    {
        setcookie('customer_session', '', time() - 3600 * 24 * 385, '/');
    }

}