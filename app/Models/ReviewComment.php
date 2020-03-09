<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ReviewComment
 *
 * @property int $id
 * @property int $review_id
 * @property int $user_id
 * @property string $comment
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReviewComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReviewComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReviewComment withoutTrashed()
 * @mixin \Eloquent
 */
class ReviewComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'review_id',
        'user_id',
        'comment'
    ];

    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
