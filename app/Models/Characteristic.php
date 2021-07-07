<?php

namespace App\Models;

use App\Traits\Models\Editable;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Characteristic extends Model
{
    use SoftDeletes;
    use Translatable;
    use Editable;

    public $timestamps = false;

    public $fillable = [
        'id',
        'name_uk',
        'prefix_uk',
        'postfix_uk',
        'name_ru',
        'prefix_ru',
        'postfix_ru',
        'type'
    ];

    public $translate = [
        'name',
        'prefix',
        'postfix'
    ];

    public $dates = [
        'deleted_at'
    ];

    public $values = [];

    public function setValues($values): void
    {
        $this->values = $values;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function isChecked($value): bool
    {
        $characteristics = request('characteristics');

        if (!is_array($characteristics)) {
            return false;
        }

        if (!isset($characteristics[$this->id])) {
            return false;
        }

        if (in_array($value, $characteristics[$this->id])) {
            return true;
        }

        return false;
    }
}
