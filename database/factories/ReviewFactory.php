<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Review::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 4),
        'product_id' => 1,
        'comment' => $faker->realText(100),
        'plus' => $faker->realText(50),
        'minus' => $faker->realText(50),
        'rating' => rand(1, 5),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => rand(0, 1) ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s', time() + rand(10, 3600)) ,
        'deleted_at' => null
    ];
});
