<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use Translatable;

    public $timestamps = false;

    protected $translate = ['name'];
}
