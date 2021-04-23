<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    protected $fillable = ['id', 'name_uk', 'name_ru'];

    public $translate = [
        'name'
    ];

    public $timestamps = false;

    public function getNameAttribute(): ?string
    {
        return $this->{"name_" . config('app.locale')};
    }

    public function product_attributes(): HasMany
    {
        return $this->hasMany('App\Models\ProductAttribute', 'attribute_id', 'id');
    }
}
