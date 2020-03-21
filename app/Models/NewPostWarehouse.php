<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class NewPostWarehouse extends Model
{
    use Translatable;

    protected $table = 'new_post_warehouses';

    protected $fillable = [
        'name_uk',
        'name_ru',
        'ref',
        'city_ref',
        'number',
        'max_weight_place',
        'max_weight_all',
        'phone'
    ];

    public $timestamps = true;

    protected $translate = ['name'];
}
