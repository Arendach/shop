<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$AjYUe0kEUHIli2vPQdEp0eBZiIJqORykhCq7t/nbmdbZX9gvwzO5m', // secret
        'remember_token' => str_random(10),
        'phone' => $faker->phoneNumber,
        'access' => rand(-1, 1),
        'locale' => rand(0, 1) ? 'ru' : 'uk'
    ];
});
