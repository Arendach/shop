<?php

namespace App\Casts;

use App\Models\Product;
use App\Models\ProductAttribute;
use PHPHtmlParser\Dom;

abstract class ProductMethodsCasts
{
    protected $templates = [
        'name',
        'categoryName',
        'article',
        'onStorage',
        'isNew',
        'isRecommended',
        'discountPercentage',
        'discountSum',
        'model',
        'weight',
        'attributes',
    ];

    private $dom;

    protected $localeCurrent;

    protected $localeDefault;

    public function __construct()
    {
        $this->dom = new  Dom();
        $this->localeCurrent = config('locale.current');
        $this->localeDefault = config('locale.default');
    }

    protected function name($model, $template)
    {
        return str_replace('<Назва>', $model->{"name_" . config('locale.current')}, $template);
    }

    protected function categoryName($model, $template)
    {
        return str_replace('<Категорія>', $model->category->{"name_" . config('locale.current')}, $template);
    }

    protected function article($model, $template)
    {
        return str_replace('<Артикул>', $model->article, $template);
    }

    protected function onStorage($model, $template)
    {
        $text = $model->on_storage ? translate('В наявності') : translate('Немає в наявності');

        return str_replace('<Доступність на складі>', $text, $template);
    }

    protected function isNew($model, $template)
    {
        $text = $model->is_new ? translate('Новинка') : '';

        return str_replace('<Новинка>', $text, $template);
    }

    protected function isRecommended($model, $template)
    {
        $text = $model->is_new ? translate('Рекомендовано') : '';

        return str_replace('<Рекомендовано>', $text, $template);
    }

    protected function discountPercentage($model, $template)
    {
        $text = $model->discount_percent ? $model->discount_percent : '';

        return str_replace('<Знижка в відсотках>', $text, $template);
    }

    protected function discountSum($model, $template)
    {
        $text = $model->discount ? $model->discount : '';

        return str_replace('<Знижка в сумі>', $text, $template);
    }

    protected function model($model, $template)
    {
        return str_replace('<Модель>', $model->model, $template);
    }

    protected function weight($model, $template)
    {
        $text = $model->weight ? $model->weight : '';

        return str_replace('<Маса>', $text, $template);
    }

    protected function attributes($model, $template): string
    {
        try {
            /** @var Product $model */
            $this->dom->load(htmlspecialchars_decode($template));

            $elements = $this->dom->find('Атрибути');

            /** @var Dom\Tag $element */
            foreach ($elements as $element) {
                $ids = explode(',', $element->id);
                $glue = $element->glue;

                $attributes = $model->attributes->whereIn('attribute_id', $ids)->map(function (ProductAttribute $attribute) use ($glue) {
                    return $attribute->attribute->name . ': ' . implode($glue, $attribute->variants);
                })->implode($glue);


                $template = $this->replaceAttribute('Атрибути', $attributes, $template);
            }

            return $template;
        } catch (\Exception $exception) {
            \Log::error('Не вдалось розпарсити атрибути товара' . $exception->getMessage());
            return $template;
        }
    }


    private function replaceAttribute($attribute, $compiled, $template)
    {
        return preg_replace("~<$attribute(.*)>~", $compiled, $template);
    }
}