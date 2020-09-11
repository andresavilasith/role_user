<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role_User\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->paragraph(),
    ];
});
