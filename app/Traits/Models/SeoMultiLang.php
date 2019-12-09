<?php

namespace App\Traits\Models;


trait SeoMultiLang
{
    /**
     * @return string|null
     */
    public function getMetaTitleAttribute()
    {
        return $this->{"meta_title_" . config('locale.current')};
    }

    /**
     * @return string|null
     */
    public function getMetaKeywordsAttribute()
    {
        return $this->{"meta_keywords_" . config('locale.current')};
    }

    /**
     * @return string|null
     */
    public function getMetaDescriptionAttribute()
    {
        return $this->{"meta_description_" . config('locale.current')};
    }
}