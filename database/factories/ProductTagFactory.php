<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Product;
use App\Models\ProductTag;

$factory->define(ProductTag::class, function (Faker $faker) {
    return [
        'title_uk'   => $faker->realText(rand(12, 32)),
        'title_ru'   => $faker->realText(rand(12, 32)),
        'product_id' => Product::inRandomOrder()->first()->id,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});
