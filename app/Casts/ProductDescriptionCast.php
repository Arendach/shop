<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ProductDescriptionCast extends ProductMethodsCasts implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        $template = $model->category->description_template;

        if (empty($template)) {
            return $model->{'description_' . $this->localeCurrent};
        }

        foreach ($this->templates as $method) {
            $template = $this->{$method}($model, $template);
        }

        return $template;
    }

    public function set($model, string $key, $value, array $attributes)
    {
       return $value;
    }
}