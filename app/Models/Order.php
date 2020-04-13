<?php

namespace App\Models;

use App\Scopes\OrderScopes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use OrderScopes;

    protected $table = 'orders';

    protected $dates = ['created_at', 'updated_at', 'date_delivery'];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'delivery',
        'comment',
        'pay_method',
        'user_id',
        'status',
        'date_delivery',
        'base_id',
        'admin'
    ];

    public function _delivery()
    {
        return $this->belongsTo(OrderDelivery::class, 'id', 'order_id');
    }

    public function self()
    {
        return $this->belongsTo(OrderSelf::class, 'id', 'order_id');
    }

    public function sending()
    {
        return $this->belongsTo(OrderSending::class, 'id', 'order_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, OrderProduct::class)
            ->withPivot('amount', 'price', 'storage');
    }

    public function getSumAttribute()
    {
        return number_format($this->products->sum(function ($item) {
            return $item->pivot->price * $item->pivot->amount;
        }), 2);
    }

    public function sum()
    {
        return $this->products->sum(function($product){
            return $product->pivot->amount * $product->pivot->price;
        });
    }
}
