<?php

namespace App\Traits\Models;

use Carbon\Carbon;

trait HumanDate
{
    function humanDate(string $field): ?string
    {
        if (!($this->$field instanceof Carbon)) {
            return null;
        }

        return $this->{$field}->format('Y / m / d');
    }

    function humanDateWithTime(string $field): ?string
    {
        if (!($this->$field instanceof Carbon)) {
            return null;
        }

        return $this->{$field}->format('Y / m / d H:i');
    }
}