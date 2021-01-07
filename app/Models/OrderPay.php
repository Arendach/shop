<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static where(string $string, $order_id)
 */
class OrderPay extends Model
{
    protected $table = 'order_pay';

    protected $fillable = [
        'result',
        'action',
        'status',
        'type',
        'paytype',
        'order_id',
        'liqpay_order_id',
        'description',
        'sender_card_mask2',
        'sender_card_bank',
        'sender_card_type',
        'amount',
        'currency',
        'sender_commission',
        'receiver_commission',
        'create_date',
        'end_date',
        'err_code',
        'err_description',
        'payment_id',
        'created_at',
        'updated_at'
    ];
    protected $guarded = [];

    public function orderShow(): HasOne
    {
        return $this->hasOne(Order::class, 'id','order_id');
    }
    public function OrderStatus()
    {
        return $this->status;
    }
}
