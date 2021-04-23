<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'created_at' => date('Y-m-d H:i:s', time() - rand(100, 100 * 100)),
        'updated_at' => date('Y-m-d H:i:s', time() - rand(100, 100 * 50)),
        'name_uk' => $faker->text(rand(20, 32)),
        'description_uk' => $faker->paragraph(rand(1, 3)),
        'meta_title_uk' => $faker->sentence(rand(4, 8)),
        'meta_description_uk' => $faker->sentence(rand(4, 8)),
        'meta_keywords_uk' => $faker->sentence(rand(4, 8)),
        'name_ru' => $faker->text(rand(20, 32)),
        'description_ru' => $faker->paragraph(rand(1, 3)),
        'meta_title_ru' => $faker->sentence(rand(4, 8)),
        'meta_description_ru' => $faker->sentence(rand(4, 8)),
        'meta_keywords_ru' => $faker->sentence(rand(4, 8)),
        'parent_id' => 0,
        'big' => null,
        'small' => null,
        'slug' => Str::slug($faker->sentence(rand(4, 8)))
    ];
});
