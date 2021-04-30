<?php

namespace Database\Factories\Role_User;

use App\Models\Role_User\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number_array = array(1, 2);
        $category_id = array_rand($number_array);
        return [
            'category_id' => $number_array[$category_id],
            'name' => $this->faker->unique()->name,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph(),
        ];
    }
}
