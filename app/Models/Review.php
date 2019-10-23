<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string $comment
 * @property string|null $plus
 * @property string|null $minus
 * @property int|null $rating
 * @property int|null $thumb_up
 * @property int|null $thumb_down
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReviewComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\ReviewThumb $thumb
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereMinus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review wherePlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereThumbDown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereThumbUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review withoutTrashed()
 * @mixin \Eloquent
 */
class Review extends Model
{
    use SoftDeletes;

    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'product_id',
        'plus',
        'minus',
        'rating',
        'comment'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\\Models\\User');
    }

    public function comments()
    {
        return $this->hasMany('App\\Models\\ReviewComment')
            ->with('user');
    }

    public function thumb()
    {
        return $this->hasOne('App\\Models\\ReviewThumb')
            ->where('user_id', user()->id);
    }

    public function delete()
    {
        $this->comments()->delete();

        return parent::delete();
    }
}
