<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Color implements Rule
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
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = str_replace('\s', '', $value);

        // HEX короткий запис
        if (preg_match('@^#[0-9abcdef]{3}$@', $value)) return true;

        // HEX повний запис
        elseif (preg_match('@^#[0-9abcdef]{6}$@', $value)) return true;

        // RGB
        elseif (preg_match('@^rgb\([0-9]{1,3},[0-9]{1,3},[0-9]{1,3}\)$@', $value)) return true;

        // RGBA
        elseif (preg_match('@^rgba\([0-9]{1,3},[0-9]{1,3},[0-9]{1,3},[0-9]?\.?[0-9]+\)$@', $value)) return true;

        // HSL
        elseif (preg_match('@^hsl\([0-9]{1,3}\,[0-9]{1,3}%,[0-9]{1,3}%\)$@', $value)) return true;

        // HSLA
        elseif (preg_match('@^hsla\([0-9]{1,3}\,[0-9]{1,3}%,[0-9]{1,3}%\,[01]?\.?[0-9]{1}\)$@', $value)) return true;

        // Error
        else return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.color');
    }
}
