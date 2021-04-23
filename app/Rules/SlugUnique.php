<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;
use Request;

class SlugUnique implements Rule
{
    /**
     * @var string
     */
    private $table;

    /**
     * SlugUnique constructor.
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $item = DB::table($this->table)
            ->where($attribute, $value)
            ->first();

        if (is_null($item))
            return true;
        elseif (Request::has('id') && $item->id == Request::get('id'))
            return true;
        else
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('validation.slug_must_unique');
    }
}
