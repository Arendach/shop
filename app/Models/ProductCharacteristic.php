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

    public $translate = [
        'value',
        'filter'
    ];

    public $timestamps = false;

    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function getPrefix()
    {
        if (is_null($this->characteristic)) {
            return $this->selfDestruction();
        }

        return $this->characteristic->prefix;
    }

    public function getPostfix()
    {
        if (is_null($this->characteristic)) {
            return $this->selfDestruction();
        }

        return $this->characteristic->postfix;
    }

    public function getName()
    {
        if (is_null($this->characteristic)) {
            return $this->selfDestruction();
        }

        return $this->characteristic->name;
    }

    public function getType()
    {
        if (is_null($this->characteristic)) {
            return $this->selfDestruction();
        }

        return $this->characteristic->type;
    }

    private function selfDestruction()
    {
        self::delete();

        return null;
    }

    public function getFilterValueAttribute()
    {
        if (!$this->filter) {
            return $this->value;
        }

        return $this->filter;
    }
}
