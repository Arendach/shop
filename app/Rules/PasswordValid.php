<?php

namespace App\Rules;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Validation\Rule;
use Request;
use Auth;

class PasswordValid implements Rule
{

    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
       return app(UserService::class)
           ->userIsValid((string)Request::get('login'), (string)Request::get('password'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('user.auth.password');
    }
}
