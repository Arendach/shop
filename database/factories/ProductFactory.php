<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'article' => str_random(15),
        'price' => $faker->randomFloat(null, 100, 10000),
        'on_storage' => rand(1, 5) > 1,
        'name_uk' => $faker->realText(rand(12, 32)),
        'description_uk' => $faker->text(rand(200, 1000)),
        'name_ru' => $faker->realText(rand(12, 32)),
        'description_ru' => $faker->text(rand(200, 1000)),
        'category_id' => 10,
        'is_new' => rand(1, 5) > 1,
        'is_recommended' => rand(1, 5) > 1,
        'discount' => rand(0, 5) > 0 ? null : $faker->randomFloat(null, 100, 10000),
        'small' => $faker->imageUrl(500, 400, 'nightlife', true, 'Faker'),
        'big' => $faker->imageUrl(1000, 800, 'nightlife', true, 'Faker'),
        'product_key' => $faker->md5,
        'meta_title_uk' => $faker->sentence(rand(3, 10)),
        'meta_keywords_uk' => $faker->words(rand(3, 10), true),
        'meta_description_uk' => $faker->sentence(rand(7, 15)),
        'meta_title_ru' => $faker->sentence(rand(3, 10)),
        'meta_keywords_ru' => $faker->words(rand(3, 10), true),
        'meta_description_ru' => $faker->sentence(rand(7, 15)),
        'manufacturer_id' => rand(1, 15),
        'slug' => Str::slug($faker->realText(rand(12, 32))) . rand(1000, 9999),
        'rating' => rand(1, 5),
        'weight' => rand(1, 5)
    ];
});
