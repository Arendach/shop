<?php

namespace App\Models;

use Cache;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    use Translatable;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    protected $fillable = [
        'uri_name',
        'name_uk',
        'name_ru',
        'content_uk',
        'content_ru',
        'meta_title_uk',
        'meta_title_ru',
        'meta_keywords_uk',
        'meta_keywords_ru',
        'meta_description_uk',
        'meta_description_ru',
        'is_fast_navigation'
    ];

    public $translate = [
        'name',
        'content',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function getUrlAttribute()
    {
        return route('page', $this->uri_name);
    }

    // Сначало сделать
    // php -d memory_limit=-1 composer.phar require chriskonnertz/bbcode
    // Потом раскоментить
//    public function getContentAttribute($value)
//    {
//        $bbcode = new ChrisKonnertz\BBCode\BBCode();
//        $rendered = $bbcode->render($value);
//        return $rendered;
//    }

    public static function created($callback)
    {
        Cache::forget('');
    }
}
