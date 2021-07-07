<?php

namespace App\Models;

use App\Traits\Models\Image;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class BannerImage extends Model implements Sortable
{
    use Translatable;
    use Image;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

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
