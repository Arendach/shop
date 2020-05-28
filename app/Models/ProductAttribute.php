<?php

namespace App\Models;

use App\Casts\ProductAttributeVariantsCast;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public $timestamps = false;

    protected $table = 'product_attributes';

    protected $fillable = ['product_id', 'attribute_id', 'variants'];

    protected $casts = [
        'variants' => ProductAttributeVariantsCast::class
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
