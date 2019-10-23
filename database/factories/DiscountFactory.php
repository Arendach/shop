<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Discount::class, function (Faker $faker) {
    return [
        'start' => date('Y-m-d H:i:s', time() - rand(0, 100 * 100)),
        'finish' => date('Y-m-d H:i:s', time() + rand(0, 100 * 100)),
        'name_uk' => $faker->text(rand(20, 32)),
        'name_ru' => $faker->text(rand(20, 32)),

        'image_min_uk' => $faker->imageUrl(60, 60, 'nightlife', true, 'Faker'),
        'image_second_uk' => $faker->imageUrl(600, 400, 'nightlife', true, 'Faker'),
        'image_max_uk' => $faker->imageUrl(1200, 400, 'nightlife', true, 'Faker'),

        'image_min_ru' => $faker->imageUrl(60, 60, 'nightlife', true, 'Faker'),
        'image_second_ru' => $faker->imageUrl(600, 400, 'nightlife', true, 'Faker'),
        'image_max_ru' => $faker->imageUrl(1200, 400, 'nightlife', true, 'Faker'),

        'page' => 'about',
        'published' => rand(0, 5) > 0 ? 1 : 0
    ];
});
