<?php

use Faker\Generator as Faker;

$factory->define(App\Models\BannerImage::class, function (Faker $faker) {
    return [
        'created_at' => date('Y-m-d H:i:s', time() - rand(100, 100 * 100)),
        'updated_at' => date('Y-m-d H:i:s', time() - rand(100, 100 * 50)),
        'path' => $faker->imageUrl(1450, 750),
        'title_uk' => $faker->text(rand(20, 32)),
        'title_ru' => $faker->text(rand(20, 32)),
        'description_uk' => $faker->text(rand(100, 1000)),
        'description_ru' => $faker->text(rand(100, 1000)),
        'url_uk' => $faker->url,
        'url_ru' => $faker->url,
        'alt_uk' => $faker->text(rand(20, 32)),
        'alt_ru' => $faker->text(rand(20, 32)),
        'color' => $faker->hexColor
    ];
});
