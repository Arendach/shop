<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductCharacteristic extends Model
{
    use Translatable;

    protected $table = 'product_characteristics';

    protected $fillable = [
        'product_id',
        'characteristic_id',
        'value_uk',
        'value_ru'
    ];

    protected $translate = ['value'];

    public $timestamps = false;

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }
}
