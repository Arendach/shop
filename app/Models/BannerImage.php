<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BannerImage
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $path
 * @property string|null $title_uk
 * @property string|null $description_uk
 * @property string|null $alt_uk
 * @property string|null $title_ru
 * @property string|null $description_ru
 * @property string|null $alt_ru
 * @property string|null $url_uk
 * @property string|null $url_ru
 * @property string|null $color
 * @property-read mixed $alt
 * @property-read mixed $description
 * @property-read mixed $image
 * @property-read mixed $title
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereAltRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereAltUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereUrlRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereUrlUk($value)
 * @mixin \Eloquent
 */
class BannerImage extends Model
{
    protected $fillable = [
        'path',
        'title_uk',
        'title_ru',
        'description_uk',
        'description_ru',
        'alt_uk',
        'alt_ru',
        'url'
    ];

    public $timestamps = true;

    public function getTitleAttribute(){
        return $this->{"title_" . config('locale.current')};
    }

    public function getDescriptionAttribute(){
        return $this->{"description_" . config('locale.current')};
    }

    public function getAltAttribute(){
        return $this->{"alt_" . config('locale.current')};
    }

    public function getImageAttribute()
    {
        if (is_file(public_path($this->path))) return asset($this->path);
        elseif (preg_match('@^http@', $this->path)) return $this->path;
        else return asset(config('default.image.banner'));
    }

    public function getUrlAttribute()
    {
        return $this->{"url_" . config('locale.current')};
    }
}
