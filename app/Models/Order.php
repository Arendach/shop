<?php

namespace App\Models;

use App\Scopes\OrderScopes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property \App\Models\OrderDelivery $delivery
 * @property string|null $comment
 * @property string|null $pay_method
 * @property int|null $user_id
 * @property string|null $status
 * @property string|null $date_delivery
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $base_id
 * @property-read \App\Models\OrderSelf $self
 * @property-read \App\Models\OrderSending $sending
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDateDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $products
 * @property-read int|null $products_count
 * @property-read mixed $sum
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order desc()
 * @property int|null $admin
 * @property float $delivery_costs
 * @property float $discount
 * @property-read \App\Models\OrderDelivery $_delivery
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeliveryCosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDiscount($value)
 */
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
