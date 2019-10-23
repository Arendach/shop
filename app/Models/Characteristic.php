<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Characteristic
 *
 * @property int $id
 * @property string $name_uk
 * @property string|null $prefix_uk
 * @property string|null $postfix_uk
 * @property string $name_ru
 * @property string|null $prefix_ru
 * @property string|null $postfix_ru
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $name
 * @property-read mixed $postfix
 * @property-read mixed $prefix
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Characteristic onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePostfixRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePostfixUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePrefixRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePrefixUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Characteristic withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Characteristic withoutTrashed()
 * @mixin \Eloquent
 */
class Characteristic extends Model
{
    public $table = 'characteristics';

    use SoftDeletes;

    public $fillable = [
        'name_uk',
        'prefix_uk',
        'postfix_uk',
        'name_ru',
        'prefix_ru',
        'postfix_ru',
        'type'
    ];

    public $timestamps = false;

    public $dates = ['deleted_at'];

    public function getNameAttribute()
    {
        return $this->{"name_" . config('app.locale')};
    }

    public function getPrefixAttribute()
    {
        return $this->{"prefix_" . config('app.locale')};
    }

    public function getPostfixAttribute()
    {
        return $this->{"postfix_" . config('app.locale')};
    }
}
