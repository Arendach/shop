<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use Translatable;

    protected $fillable = [
        'name_uk',
        'name_ru',
        'address_uk',
        'address_ru',
        'url',
        'base_id'
    ];

    public $translate = [
        'name',
        'address'
    ];

    public $timestamps = false;
}
