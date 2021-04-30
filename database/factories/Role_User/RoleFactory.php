<?php

namespace Database\Factories\Role_User;

use App\Models\Role_User\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $full_access = array('yes', 'no');
        $yes_no = array_rand($full_access);
        return [
            'name' => $this->faker->unique()->name,
            'slug' => $this->faker->unique()->name,
            'description' => $this->faker->paragraph(),
            'full_access' => $full_access[$yes_no]
        ];
    }
}
