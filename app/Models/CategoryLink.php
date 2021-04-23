<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryLink extends Model
{
    protected $table = 'category_links';

    protected $fillable = ['name_uk', 'name_ru', 'url_uk', 'url_ru'];

    public $timestamps = false;

    public function getNameAttribute()
    {
        $locale = config('app.locale');
        return $this->{"name_$locale"};
    }

    public function getUrlAttribute()
    {
        $locale = config('app.locale');
        return $this->{"url_$locale"};
    }
}
