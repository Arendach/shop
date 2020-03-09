<?php

namespace App\Observers;

use App\Models\Customer;

class CustomerObserver
{
    public function creating(Customer $customer)
    {
        if (mb_strlen($customer->password) != 32) {
            $customer->password = md5($customer->password);
        }

        if (mb_strlen($customer->session) != 32) {
            $customer->session = md5($customer->password . $customer->phone . $customer->email);
        }
    }
}
