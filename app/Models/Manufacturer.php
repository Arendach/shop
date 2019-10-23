<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Manufacturer
 *
 * @property int $id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $photo_uk
 * @property string $photo_ru
 * @property-read mixed $name
 * @property-read mixed $photo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer wherePhotoRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer wherePhotoUk($value)
 * @mixin \Eloquent
 */
class Manufacturer extends Model
{
    protected $table = 'manufacturers';

    protected $fillable = [
        'name_uk',
        'name_ru',
        'photo_uk',
        'photo_ru'
    ];

    public $timestamps = false;

    public function getNameAttribute()
    {
        return $this->{"name_" . config('app.locale')};
    }

    public function getPhotoAttribute()
    {
        return $this->{"photo_" . config('app.locale')};
    }

}
