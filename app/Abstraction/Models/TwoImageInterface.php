<?php

namespace App\Abstraction\Models;

interface TwoImageInterface
{
    public function getBigImageAttribute(): string;

    public function getSmallImageAttribute(): string;

}