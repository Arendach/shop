<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ProductName extends ProductCastAbstract implements CastsAttributes
{
    private $templates = [
        'name'               => '<Назва>',
        'categoryName'       => '<Категорія>',
        'article'            => '<Артикул>',
        'onStorage'          => '<Доступність на складі>',
        'isNew'              => '<Новинка>',
        'isRecommended'      => '<Рекомендовано>',
        'discountPercentage' => '<Знижка в відсотках>',
        'discountSum'        => '<Знижка в сумі>',
        'model'              => '<Модель>',
        'weight'             => '<Маса>'
    ];

    public function get($model, string $key, $value, array $attributes)
    {
        $template = $model->category->name_template;

        if (empty($template)) {
            return $model->{"name_" . config('locale.current')};
        }

        foreach ($this->templates as $method => $needle) {
            if (strpos($model->category->name_template, $needle) !== false) {
                $template = $this->{$method}($model, $template);
            }
        }

        return $template;
    }


    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }

    private function name($model, $value)
    {
        return str_replace('<Назва>', $model->{"name_" . config('locale.current')}, $value);
    }

    private function categoryName($model, $value)
    {
        return str_replace('<Категорія>', $model->category->{"name_" . config('locale.current')}, $value);
    }

    private function article($model, $value)
    {
        return str_replace('<Артикул>', $model->article, $value);
    }

    private function onStorage($model, $value)
    {
        $text = $model->on_storage ? translate('В наявності') : translate('Немає в наявності');

        return str_replace('<Доступність на складі>', $text, $value);
    }

    private function isNew($model, $value)
    {
        $text = $model->is_new ? translate('Новинка') : '';

        return str_replace('<Новинка>', $text, $value);
    }

    private function isRecommended($model, $value)
    {
        $text = $model->is_new ? translate('Рекомендовано') : '';

        return str_replace('<Рекомендовано>', $text, $value);
    }

    private function discountPercentage($model, $value)
    {
        $text = $model->discount_percent ? $model->discount_percent : '';

        return str_replace('<Знижка в відсотках>', $text, $value);
    }

    private function discountSum($model, $value)
    {
        $text = $model->discount ? $model->discount : '';

        return str_replace('<Знижка в сумі>', $text, $value);
    }

    private function model($model, $value)
    {
        return str_replace('<Модель>', $model->model, $value);
    }

    private function weight($model, $value)
    {
        $text = $model->weight ? $model->weight : '';

        return str_replace('<Маса>', $text, $value);
    }
}