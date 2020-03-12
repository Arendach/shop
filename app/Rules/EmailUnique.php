<?php

namespace App\Rules;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class EmailUnique implements Rule
{
    public function passes($attribute, $value)
    {
        return !(Customer::where('email', $value)->count());
    }

    public function message()
    {
        return translate('Покупець з таким Email вже зарестрований на сайті!');
    }
}
