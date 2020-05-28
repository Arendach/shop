<?php


namespace App\Casts;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ProductAttributeVariantsCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (empty($value)) {
            return [];
        }

        $variants = json_decode($value);

        $result = [];
        foreach ($variants as $variant) {
            $result[] = $variant->{"value_" . config('locale.current')} ?? '';
        }

        return $result;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode($value);
    }
}