<?php

namespace App\Rules;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Validation\Rule;
use Request;

class UserExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return app(UserService::class)->userExists((string)Request::get('login'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('user.auth.login');
    }
}
