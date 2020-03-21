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
        'value_ru',
        'filter_uk',
        'filter_ru'
    ];

    protected $translate = [
        'value',
        'filter'
    ];

    public $timestamps = false;

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function getFilterValueAttribute(): ?string
    {
        if (is_null($this->flter)) {
            return $this->value;
        }

        return $this->filter;
    }
}
