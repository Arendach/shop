<?php

namespace App\Traits\Models;

trait TwoImage
{
    /**
     * Путь к минимизированному изображению
     *
     * @return string
     */
    public function getSmallImageAttribute(): string
    {
        if (config('app.debug')) {
            return asset('catalog/img/product.jpg');
        }

        if (empty($this->small)) {
            return $this->big_image;
        }

        // если файл найдень в публической директории
        // то возвращаем к нему полный путь
        if (is_file(public_path($this->small))) return asset($this->small);

        // если в пути файла найдено протокол http(s) то возвращаем как есть
        elseif (preg_match('/^http/', $this->small)) return $this->small;

        // путь к картинке фото не найдено
        else return asset(config('default.image.product_small'));
    }

    /**
     * Путь к большому изображению(возможно оригиналу)
     *
     * @return string
     */
    public function getBigImageAttribute(): string
    {
        if (config('app.debug')) {
            return asset('catalog/img/product.jpg');
        }

        if (is_file(public_path($this->big))) return asset($this->big);
        elseif (preg_match('/^http/', $this->big)) return $this->big;
        else return asset(config('default.image.product_big'));
    }
}