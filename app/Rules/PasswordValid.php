<?php

namespace App\Rules;

use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Contracts\Validation\Rule;
use Request;
use Auth;

class PasswordValid implements Rule
{
    public function passes($attribute, $value)
    {
       return app(CustomerService::class)
           ->userIsValid((string)Request::get('login'), (string)Request::get('password'));
    }

    public function message()
    {
        return translate('Не вірний пароль');
    }
}
