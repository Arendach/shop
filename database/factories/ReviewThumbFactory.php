<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ReviewThumb::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 4),
        'review_id' => rand(1, 10),
        'quality' => rand(-1, 1),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
});
