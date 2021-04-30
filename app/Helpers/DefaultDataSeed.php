<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Role_User\Role;
use App\Models\Role_User\Category;
use App\Models\Role_User\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DefaultDataSeed
{
    use RefreshDatabase;

    public static function default_data_seed()
    {
        User::factory()->create([
            'name' => 'super admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234')
        ]);


        Role::factory()->create(
            [
                'name' => 'admin',
                'slug' => 'admin',
                'description' => 'User admin',
                'full_access' => 'yes'
            ]
        );

        $role = Role::first();

        Category::factory()->count(2)->create();
        
        
        $category=Category::first();
        
        
        Permission::factory()->times(2)->create();

        $permissions = Permission::all();

        

        // Populate the pivot table
        User::all()->each(function ($user) use ($role) {
            $user->roles()->sync(
                $role->id
            );
        });


        // Populate the pivot table
        Role::all()->each(function ($role) use ($permissions) {
            $role->permissions()->sync(
                $permissions
            );
        });
    }

}
