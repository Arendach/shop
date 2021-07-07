<?php

namespace App\Models;

use App\Abstraction\Models\SearchableInterface;
use App\Casts\PageAttributeCasts;
use App\Traits\Searchable;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model implements SearchableInterface
{
    use SoftDeletes;
    use Translatable;
    use Searchable;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    public $timestamps = true;
    protected $guarded = [];

    protected $casts = [
        'content_ru' => PageAttributeCasts::class,
        'content_uk' => PageAttributeCasts::class
    ];

    public $translate = [
        'name',
        'content',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function getUrlAttribute(): string
    {
        return route('page', $this->uri_name);
    }

    public function toSearchArray(): array
    {
        return [
            'id'                  => $this->id,
            'name_uk'             => $this->name_uk,
            'name_ru'             => $this->name_ru,
            'description_uk'      => $this->content_uk,
            'description_ru'      => $this->content_ru,
            'meta_title_uk'       => $this->meta_title_uk,
            'meta_title_ru'       => $this->meta_title_ru,
            'meta_keywords_uk'    => $this->meta_keywords_uk,
            'meta_keywords_ru'    => $this->meta_keywords_ru,
            'meta_description_uk' => $this->meta_description_uk,
            'meta_description_ru' => $this->meta_description_ru,
            'url'                 => $this->getUrl(),
        ];
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
