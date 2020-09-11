<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role_User\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    $full_access = array('yes', 'no');
    $yes_no = array_rand($full_access);
    return [
        'name' => $faker->unique()->name,
        'slug' => $faker->unique()->name,
        'description' => $faker->paragraph(),
        'full_access' => $full_access[$yes_no]
    ];
});
