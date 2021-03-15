<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Exception;
use Log;

class ProductAttributeVariantsCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        $result = [];
        try {
            $variants = json_decode(json_decode($value));

            foreach ($variants as $variant) {
                $result[] = $variant->{"value_" . config('locale.current')} ?? '';
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $result;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode($value);
    }
}