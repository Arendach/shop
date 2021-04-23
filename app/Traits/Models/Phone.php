<?php

namespace App\Traits\Models;

trait Phone
{
    public function phone(string $key = 'phone'): string
    {
        return "+" . preg_replace('~[A-z\s\-+()]+~', '', $this->{$key});
    }

    public function formatPhone(string $key = 'phone')
    {
        return $this->{$key};
    }
}