<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Discount
 *
 * @property int $id
 * @property string|null $start
 * @property string|null $finish
 * @property string|null $name_uk
 * @property string|null $name_ru
 * @property string|null $image_min_uk
 * @property string|null $image_second_uk
 * @property string|null $image_max_uk
 * @property string|null $image_min_ru
 * @property string|null $image_second_ru
 * @property string|null $image_max_ru
 * @property string|null $page
 * @property string $published
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read mixed $finish_f
 * @property-read mixed $image_max
 * @property-read mixed $image_min
 * @property-read mixed $image_second
 * @property-read mixed $name
 * @property-read mixed $start_f
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereFinish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageMaxRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageMaxUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageMinRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageMinUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageSecondRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageSecondUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount withoutTrashed()
 * @mixin \Eloquent
 */
class Discount extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    public function getStartFAttribute()
    {
        return $this->start;
    }

    public function getFinishFAttribute()
    {
        return $this->finish;
    }

    public function getImageMinAttribute()
    {
        return $this->{"image_min_" . config('app.locale')};
    }

    public function getImageSecondAttribute()
    {
        return $this->{"image_second_" . config('app.locale')};
    }

    public function getImageMaxAttribute()
    {
        return $this->{"image_max_" . config('app.locale')};
    }

    public function getNameAttribute()
    {
        return $this->{"name_" . config('app.locale')};
    }
}
