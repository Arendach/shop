<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use Translatable;

    protected $fillable = [
        'name_uk',
        'name_ru',
        'photo_uk',
        'photo_ru'
    ];

    public $translate = ['name'];

    public $timestamps = false;

    public function isChecked(): bool
    {
        $manufacturers = request('manufacturers');

        if (!is_array($manufacturers)) {
            return false;
        }

        if (in_array($this->id, $manufacturers)) {
            return true;
        }

        return false;
    }
}
