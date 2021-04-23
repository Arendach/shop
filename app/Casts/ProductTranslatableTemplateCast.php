<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Cache;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCharacteristic;
use PHPHtmlParser\Dom;
use Exception;

class ProductTranslatableTemplateCast implements CastsAttributes
{
    protected $templates = [
        'name',
        'article',
        'discountPercentage',
        'discountSum',
        'model',
        'weight',
        'attributes',
        'characteristics',
        'characteristics2',
        'description',
        'manufacturer',
        'packing',
        'manufacturerLink',
        'volume'
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

    public function get($model, string $key, $value, array $attributes)
    {
        return Cache::rememberForever("{$key}-{$model->id}", function () use ($key, $model) {
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
        });
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }


    protected function name(Product $model, string $template): string
    {
        return str_ireplace('<Name>', $model->{"name_" . config('locale.current')}, $template);
    }

    protected function article(Product $model, string $template): string
    {
        return str_ireplace('<Articul>', $model->article, $template);
    }

    protected function discountPercentage(Product $model, string $template): string
    {
        $text = $model->discount_percent ? $model->discount_percent : '';

        return str_ireplace('<DiscountPercent>', $text, $template);
    }

    public function discountSum(Product $model, string $template): string
    {
        $text = $model->discount ? $model->discount : '';

        return str_ireplace('<DiscountSum>', $text, $template);
    }

    protected function model(Product $model, string $template): string
    {
        return str_ireplace('<Model>', $model->{"model_" . config('locale.current')}, $template);
    }

    protected function weight(Product $model, string $template): string
    {
        $text = $model->weight ? $model->weight . ' кг' : '';

        return str_ireplace('<Weight>', $text, $template);
    }

    protected function description(Product $model, $template): string
    {
        $text = $model->getOriginal("description_" . config('locale.current'));

        return str_ireplace('<Description>', $text, $template);
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
            return $template;
        }
    }

    protected function manufacturerLink(Product $model, $template): string
    {
        try {
            /** @var Product $model */
            $this->dom->load(htmlspecialchars_decode($template));

            $elements = $this->dom->find('ManufacturerLink');

            if (!count($elements)) {
                return $template;
            }

            $manufacturer = $model->manufacturer;

            /** @var Dom\Tag $element */
            $element = $elements[0];
            $text = is_null($element->text) ? $manufacturer->name : $element->text;

            return $this->replaceAttribute('ManufacturerLink', "<a href='{$manufacturer->url}'>{$text}</a>", $template);
        } catch (Exception $exception) {
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
            foreach ($elements as $element) {
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
            }

            return $template;

        } catch (Exception $exception) {
            return $template;
        }
    }
    protected function characteristics2(Product $model, string $template): string
    {
        try {
            for ($i = 1; $i < 6; $i++){
                /** @var Product $model */
                $this->dom->load($template);

                $elements = $this->dom->find('Characteristics' . $i);

                if (!count($elements)) {
                    return $template;
                }

                /** @var Dom\Tag $element */
                foreach ($elements as $element) {
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

                    $template = $this->replaceAttribute('Characteristics' . $i, $characteristics, $template);
                }
            }

            return $template;
        } catch (Exception $exception) {
            return $template;
        }
    }

    private function replaceAttribute($attribute, $compiled, $template)
    {
        return preg_replace("~<$attribute(.*)>~U", $compiled, $template);
    }

    protected function packing(Product $model, string $template): string
    {
        try {
            $packing = json_decode($model->packing);

            $template = str_ireplace('<Packing a>', $packing[0] ?? '', $template);
            $template = str_ireplace('<Packing b>', $packing[1] ?? '', $template);
            $template = str_ireplace('<Packing c>', $packing[2] ?? '', $template);

            return $template;
        } catch (Exception $exception) {
            return $template;
        }
    }

    protected function volume(Product $model, string $template): string
    {
        try {
            $volume = json_decode($model->volume);

            $template = str_ireplace('<Volume a>', $volume[0] ?? '', $template);
            $template = str_ireplace('<Volume b>', $volume[1] ?? '', $template);
            $template = str_ireplace('<Volume c>', $volume[2] ?? '', $template);

            return $template;
        } catch (Exception $exception) {
            return $template;
        }
    }
}