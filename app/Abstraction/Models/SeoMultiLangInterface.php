<?php

namespace App\Abstraction\Models;

interface SeoMultiLangInterface
{
    public function getMetaTitleAttribute();

    public function getMetaKeywordsAttribute();

    public function getMetaDescriptionAttribute();
}