<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use Translatable;

    protected $table = 'product_attributes';

    public $timestamps = false;

    protected $fillable = ['product_id', 'attribute_id', 'value_uk', 'value_ru'];


    public $translate = [
        'value'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
