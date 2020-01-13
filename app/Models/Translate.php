<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translate
 *
 * @property int $id
 * @property string $original
 * @property string $content_uk
 * @property string $content_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate whereContentRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate whereContentUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Translate extends Model
{
    protected $fillable = [
        'original',
        'content_ru',
        'content_uk'
    ];

    public function getContentAttribute()
    {
        return $this->{"content_" . config('locale.current')};
    }
}
