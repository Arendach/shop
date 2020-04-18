<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ProductTranslatableTemplateCast extends ProductMethodsCasts implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        $field = "{$key}_{$this->localeCurrent}";
        $locale = config('locale.current');
        $template = $model->category->{"{$key}_template_{$locale}"};

        if (empty($template)) {
            return $model->$field;
        }

        foreach ($this->templates as $method) {
            $template = $this->$method($model, $template);
        }

        return $template;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}