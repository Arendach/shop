<?php

namespace App\Casts;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCharacteristic;
use PHPHtmlParser\Dom;
use Exception;
use Log;

abstract class ProductMethodsCasts
{
    protected $templates = [
        'name',
        'categoryName',
        'article',
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
        return str_ireplace('<Name>', $model->{"name_" . config('locale.current')}, $template);
    }

    protected function categoryName(Product $model, string $template): string
    {
        return str_ireplace('<Category>', $model->category->{"name_" . config('locale.current')}, $template);
    }

    protected function article($model, $template)
    {
        return str_ireplace('<Articul>', $model->article, $template);
    }

    protected function discountPercentage($model, $template)
    {
        $text = $model->discount_percent ? $model->discount_percent : '';

        return str_ireplace('<DiscountPercent>', $text, $template);
    }

    public function discountSum(Product $model, string $template): string
    {
        $text = $model->discount ? $model->discount : '';

        return str_ireplace('<DiscountSum>', $text, $template);
    }

    protected function model($model, $template)
    {
        return str_ireplace('<Model>', $model->{"model_" . config('locale.current')}, $template);
    }

    protected function weight($model, $template)
    {
        $text = $model->weight ? $model->weight : '';

        return str_ireplace('<Weight>', $text, $template);
    }

    protected function description(Product $model, $template): string
    {
        return str_ireplace('<Description>', $model->getOriginal("description_" . config('locale.current')), $template);
    }

    protected function manufacturer(Product $model, $template): string
    {
        return str_ireplace('<Manufacturer>', $model->manufacturer->name, $template);
    }

    protected function attributes(Product $model, $template): string
    {
        try {
            /** @var Product $model */
            $this->dom->load(htmlspecialchars_decode($template));

            $elements = $this->dom->find('Attributes');

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

            $template = $this->replaceAttribute('Attributes', $attributes, $template);

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
            $this->dom->load($template);

            $elements = $this->dom->find('Characteristics');

            if (!count($elements)) {
                return $template;
            }

            /** @var Dom\Tag $element */
            $element = $elements[0];

            $glue = is_null($element->glue) ? ',' : $element->glue;
            $ids = is_null($element->id) ? null : explode(',', $element->id);
            $title = $element->hasAttribute('title');
            $prefix = $element->hasAttribute('prefix');
            $postfix = $element->hasAttribute('postfix');

            $characteristics = $model->characteristics;

            if (!is_null($ids)) {
                $characteristics = $characteristics->whereIn('characteristic_id', $ids);
            }

            $characteristics = $characteristics->map(function (ProductCharacteristic $characteristic) use ($glue, $title, $prefix, $postfix) {
                $result = '';

                if ($title) {
                    $result .= trim($characteristic->getName(), ':') . ': ';
                }

                if ($prefix) {
                    $result .= " " . $characteristic->getPrefix() . ' ';
                }

                $result .= $characteristic->value;

                if ($postfix) {
                    $result .= " " . $characteristic->getPostfix() . ' ';
                }

                return $result;
            })->implode($glue);

            $template = $this->replaceAttribute('Characteristics', $characteristics, $template);

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