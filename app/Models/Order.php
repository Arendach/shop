<?php

namespace App\Models;

use App\Scopes\OrderScopes;
use App\Traits\Models\HumanDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use OrderScopes;
    use HumanDate;

    protected $table = 'orders';

    protected $dates = ['created_at', 'updated_at', 'date_delivery'];

    protected $fillable = [
        'name',
        'phone',
        'email',
        'delivery',
        'comment',
        'pay_method',
        'customer_id',
        'status',
        'date_delivery',
        'base_id',
        'admin',
        'delivery_costs',
        'discount',
        'city',
        'street',
        'address',
        'warehouse_id',
        'shop_id'
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(NewPostWarehouse::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('amount', 'price', 'storage', 'attribute');
    }

    public function getSumAttribute()
    {
        return number_format($this->products->sum(function ($item) {
            return $item->pivot->price * $item->pivot->amount;
        }), 2);
    }

    public function sum()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->amount * $product->pivot->price;
        });
    }
    public function paymethods()
    {
        return $this->belongsTo(Payment::class, 'pay_method','key');
    }

}
