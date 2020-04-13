<?php

namespace App\Models;

use App\Traits\Models\Image;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    use Translatable;
    use Image;

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

    public $translate = [
        'title',
        'description',
        'button'
    ];

    protected $images = [
        'image' => '/catalog/img/not-found-1100x400.jpg'
    ];
}
