<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class NewPostCity extends Model
{
    use Translatable;

    protected $table = 'new_post_cities';

    protected $fillable = [
        'name_uk',
        'name_ru',
        'ref',
        'prefix'
    ];

    public $timestamps = true;

    protected $translate = ['name'];
}
