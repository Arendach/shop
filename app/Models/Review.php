<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';

    protected $fillable = [
        'customer_id',
        'product_id',
        'plus',
        'minus',
        'rating',
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


    // deprecated
    public function comments()
    {
        return $this->hasMany('App\\Models\\ReviewComment')->with('user');
    }

    public function delete()
    {
        $this->comments()->delete();

        return parent::delete();
    }
}
