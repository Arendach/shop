<?php

namespace App\Rules;

use App\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class PhoneUnique implements Rule
{
    public function passes($attribute, $value)
    {
        return !Customer::where('phone', $this->preparePhone($value))->count();
    }

    public function message(): string
    {
        return translate('Покупець з таким номером вже зареєстрований');
    }

    private function preparePhone(string $phone): string
    {
        return str_replace('-', '', $phone);
    }
}
