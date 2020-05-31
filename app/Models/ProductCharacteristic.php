<?php

namespace App\Models;

use App\Traits\Models\Editable;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductCharacteristic extends Model
{
    use Translatable;
    use Editable;

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

    public function getPrefix(bool $editable = false)
    {
        if (is_null($this->characteristic)) {
            return $this->selfDestruction();
        }

        return $editable ? $this->characteristic->editable('prefix') : $this->characteristic->prefix;
    }

    public function getPostfix(bool $editable = false)
    {
        if (is_null($this->characteristic)) {
            return $this->selfDestruction();
        }

        return $editable ? $this->characteristic->editable('postfix') : $this->characteristic->postfix;
    }

    public function getName(bool $editable = false)
    {
        if (is_null($this->characteristic)) {
            return $this->selfDestruction();
        }

        return $editable ? $this->characteristic->editable('name') : $this->characteristic->name;
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
