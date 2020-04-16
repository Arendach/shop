<?php

namespace App\Casts;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCharacteristic;
use PHPHtmlParser\Dom;
use Exception;
use Log;
use function GuzzleHttp\Psr7\str;

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
        'characteristics',
        'description',
        'model',
        'manufacturer'
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
        return str_replace('<Модель>', $model->{"model_" . config('locale.current')}, $template);
    }

    protected function weight($model, $template)
    {
        $text = $model->weight ? $model->weight : '';

        return str_replace('<Маса>', $text, $template);
    }

    protected function description(Product $model, $template): string
    {
        return str_replace('<Опис>', $model->getOriginal("description_" . config('locale.current')), $template);
    }

    protected function manufacturer(Product $model, $template): string
    {
        return str_replace('<Виробник>', $model->manufacturer->name, $template);
    }

    protected function attributes(Product $model, $template): string
    {
        try {
            /** @var Product $model */
            $this->dom->load(htmlspecialchars_decode($template));

            $elements = $this->dom->find('Атрибути');

            if (!count($elements)) {
                return $template;
            }

            /** @var Dom\Tag $element */
            $element = $elements[0];
            $ids = is_null($element->id) ? null : explode(',', $element->id);
            $glue = is_null($element->glue) ? ',' : $element->glue;
            $del = is_null($element->del) ? '-' : $element->del;

            $attributes = $model->attributes;

            if (!is_null($ids)) {
                $attributes = $attributes->whereIn('attribute_id', $ids);
            }

            $attributes = $attributes->map(function (ProductAttribute $attribute) use ($del) {
                return $attribute->attribute->name . ': ' . implode($del, $attribute->variants);
            })->implode($glue);

            $template = $this->replaceAttribute('Атрибути', $attributes, $template);

            return $template;
        } catch (Exception $exception) {
            Log::error('Не вдалось розпарсити атрибути товара' . $exception->getMessage());
            return $template;
        }
    }

    protected function characteristics(Product $model, string $template): string
    {
        try {
            /** @var Product $model */
            $this->dom->load(htmlspecialchars_decode($template));

            $elements = $this->dom->find('Характеристики');

            if (!count($elements)) {
                return $template;
            }

            /** @var Dom\Tag $element */
            $element = $elements[0];

            $glue = is_null($element->glue) ? ',' : $element->glue;
            $ids = is_null($element->id) ? null : explode(',', $element->id);

            $characteristics = $model->characteristics;

            if (!is_null($ids)) {
                $characteristics = $characteristics->whereIn('characteristic_id', $ids);
            }

            $characteristics = $characteristics->map(function (ProductCharacteristic $characteristic) use ($glue) {
                return trim($characteristic->getName(), ':') . ': ' . $characteristic->value;
            })->implode($glue);

            $template = $this->replaceAttribute('Характеристики', $characteristics, $template);

            return $template;

        } catch (Exception $exception) {
            Log::error('Не вдалось розпарсити характеристики товара' . $exception->getMessage());
            return $template;
        }
    }

    private function replaceAttribute($attribute, $compiled, $template)
    {
        return preg_replace("~<$attribute(.*)>~U", $compiled, $template);
    }
}