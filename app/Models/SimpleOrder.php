<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpleOrder extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'ip',
        'user_agent',
        'product_id',
        'accepted'
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo('App\\Models\\Product');
    }
}
