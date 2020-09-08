<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role_User\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    $number_array = array(1, 2);
    $category_id=array_rand($number_array);

    return [
        'category_id' => $number_array[$category_id],
        'name' => $faker->unique()->name,
        'slug' => $faker->unique()->slug,
        'description' => $faker->paragraph(),
    ];
});
