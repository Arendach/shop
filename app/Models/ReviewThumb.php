<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ReviewThumb
 *
 * @property int $id
 * @property int $user_id
 * @property int $review_id
 * @property int $quality
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereQuality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereUserId($value)
 * @mixin \Eloquent
 */
class ReviewThumb extends Model
{
    //
}
