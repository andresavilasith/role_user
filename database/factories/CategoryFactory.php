<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role_User\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->paragraph(),
    ];
});
