<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Settings
 *
 * @property int $id
 * @property string $key
 * @property string $value_uk
 * @property string $value_ru
 * @property string $description_uk
 * @property string $description_ru
 * @property-read mixed $description
 * @property-read mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereValueRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereValueUk($value)
 * @mixin \Eloquent
 */
class Settings extends Model
{
    protected $table = 'settings';

    public function getValueAttribute()
    {
        if (is_null($this->value_ru))
            return $this->value_uk;

        return $this->{"value_" . config('locale.current')};
    }

    public function getDescriptionAttribute()
    {
        if (is_null($this->description_ru))
            return $this->description_uk;

        return $this->{"description_" . config('locale.current')};
    }
}
