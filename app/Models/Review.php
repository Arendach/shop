<?php

namespace App\Models;

use App\Traits\Models\HumanDate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    use HumanDate;

    protected $table = 'reviews';

    protected $fillable = [
        'customer_id',
        'product_id',
        'plus',
        'minus',
        'rating',
        'title',
        'comment'
    ];

    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'first_name' => translate('Гість'),
            'last_name'  => ''
        ]);
    }

    public function getStarsAttribute()
    {
        $rating = $this->rating;

        $result = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $result .= '<i class="icon-star"></i>';
            } else {
                $result .= '<i class="icon-star empty"></i>';
            }
        }

        return $result;
    }
}
