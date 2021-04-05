<?php

namespace App\SyncHelpers;

use App\Library\FileImport;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCharacteristic;
use App\Models\ProductImage;
use Image;
use Illuminate\Support\Str;
use Exception;


class ProductImportHelper
{
    public function __construct($data)
    {
        // створення товару в базі даних
        $product_id = $this->load_info($data);

        // підгрузка атрибутів
        $this->load_attributes($data->attributes, $product_id);

        // підгрузка характеристик
        $this->load_characteristics($data->characteristics, $product_id);

        // підгрузка зображень
        $this->load_images($data->images, $product_id);
    }

    private function load_info($data): int
    {
        $data = (array)$data;
        $data = collect($data);

        $slug = Str::slug($data->get('name_uk'));

        if (Product::where('slug', $slug)->count()) {
            $slug .= rand(10, 99);
        }

        $data->put('slug', $slug);

        $data = $data->filter(function ($item) {
            return is_string($item) || is_numeric($item) || is_null($item);
        })->toArray();

        return Product::create($data)->id;
    }

    private function load_images($images, $product_id): void
    {
        // якщо в товарі є картинки
        try {
            if (count($images) > 0) {
                foreach ($images as $i => $image) {
                    $url = config('app.base_url') . $image;
                    $extension = pathinfo($url)['extension'];
                    $name = Str::uuid()->getNodeHex();
                    $path = "/images/products/$product_id/";
                    $path_original = $path . $name . '.' . $extension;
                    $path_1000 = $path . '1000_' . $name . '.' . $extension;
                    $path_500 = $path . '500_' . $name . '.' . $extension;

                    // Імпорт файлу
                    $file_import = new FileImport($url, $path_original);

                    // якщо файл вдало імпортовано
                    if ($file_import) {
                        // Установка головного фото
                        if ($i == 0) {
                            $product = Product::find($product_id);

                            $product->small = $path_500;
                            $product->big = $path_1000;

                            $product->save();
                        }

                        // Ресайз до 1000 пікселів(по ширині)
                        $img = Image::make(public_path($path_original));
                        $coefficient = $img->height() / $img->width();
                        $img->resize(1000, 1000 * $coefficient);
                        $img->save(public_path($path_1000));

                        // Ресайз до 500 пікселів(по ширині)
                        $img = Image::make(public_path($path_original));
                        $coefficient = $img->height() / $img->width();
                        $img->resize(500, 500 * $coefficient);
                        $img->save(public_path($path_500));

                        // збереження картинки в базу даних
                        $product_image = new ProductImage;
                        $product_image->big = $path_1000;
                        $product_image->small = $path_500;
                        $product_image->product_id = $product_id;
                        $product_image->save();
                    }

                    unlink(public_path($path_original));
                }
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }

    private function load_characteristics($characteristics, $product_id): void
    {
        try {
            if (count($characteristics) > 0) {
                foreach ($characteristics as $item) {
                    $isset = ProductCharacteristic::where('product_id', $product_id)
                        ->where('characteristic_id', $item->characteristic_id)
                        ->count();

                    if ($isset) continue;

                    $characteristic = new ProductCharacteristic;

                    $characteristic->characteristic_id = $item->characteristic_id;
                    $characteristic->value_uk = $item->value_uk;
                    $characteristic->value_ru = $item->value_ru;
                    $characteristic->filter_uk = $item->filter_uk;
                    $characteristic->filter_ru = $item->filter_ru;
                    $characteristic->product_id = $product_id;

                    $characteristic->save();
                }
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }

    private function load_attributes($attributes, $product_id): void
    {
        $attributes = collect($attributes)->toArray();

        try {
            if (count($attributes) > 0) {
                foreach ($attributes as $item) {
                    foreach ($item->variants as $variant){
                        $attribute = new ProductAttribute;

                        $attribute->product_id = $product_id;
                        $attribute->attribute_id = $item->attribute_id;
//                        $attribute->variants = json_encode($item->variants);
                        $attribute->value_ru = $variant->value_ru;
                        $attribute->value_uk = $variant->value_uk;

                    }

                    $attribute->save();
                }
            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}