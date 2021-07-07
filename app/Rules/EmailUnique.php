<?php

namespace App\Rules;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class EmailUnique implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (!$value) {
            return true;
        }

        return !(Customer::where('email', $value)->count());
    }

    public function message(): string
    {
        return translate('Покупець з таким Email вже зарестрований');
    }
}
