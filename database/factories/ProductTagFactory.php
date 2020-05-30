<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\ProductTag::class, function (Faker $faker) {
    return [
        'title_uk'   => $faker->realText(rand(12, 32)),
        'title_ru'   => $faker->realText(rand(12, 32)),
        'product_id' => rand(1, 347),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});
