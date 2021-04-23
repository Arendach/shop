<?php

use Faker\Generator as Faker;
use App\Models\Manufacturer;

$factory->define(Manufacturer::class, function (Faker $faker) {
    return [
        'name_uk' => $faker->company,
        'name_ru' => $faker->company,
        'photo_uk' => $faker->imageUrl(300, 150),
        'photo_ru' => $faker->imageUrl(300, 150),
    ];
});
