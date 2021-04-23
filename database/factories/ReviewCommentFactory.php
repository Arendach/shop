<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ReviewComment::class, function (Faker $faker) {
    return [
        'user_id' => 2,
        'review_id' => rand(1, 10),
        'comment' => $faker->realText(40),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'deleted_at' => null
    ];
});
