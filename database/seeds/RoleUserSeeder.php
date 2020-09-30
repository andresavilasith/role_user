<?php

use App\Models\Role_User\Category;
use App\Models\Role_User\Permission;
use App\Models\Role_User\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Desacticar todas las claves foraneas
        DB::statement('SET foreign_key_checks=0');
        //Truncar o vaciar las tablas
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();
        Permission::truncate();
        Role::truncate();
        Category::truncate();

        $useradmin = User::where('email', 'admin@admin.com')->first();
        if ($useradmin) {
            $useradmin->delete();
        }
        $useradmin = User::create([

            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234') // password sin encriptar
        ]);
        $userguest = User::where('email', 'guest@guest.com')->first();
        if ($userguest) {
            $userguest->delete();
        }
        $userguest = User::create([

            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('1234') // password sin encriptar
        ]);


        //rol de admin
        $roleadmin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrator',
            'full_access' => 'yes'
        ]);
        //Definir role_user
        $useradmin->roles()->sync([$roleadmin->id]);

        //rol de guest
        $roleguest = Role::create([
            'name' => 'Guest',
            'slug' => 'guest',
            'description' => 'Guest',
            'full_access' => 'no'
        ]);


        //Definir role_user
        $userguest->roles()->sync([$roleguest->id]);

        //Categorias
        $user_category = Category::create([
            'name' => 'User',
            'description' => 'All the user functions'
        ]);
        $role_category = Category::create([
            'name' => 'Role',
            'description' => 'All the role functions'
        ]);
        $self_category = Category::create([
            'name' => ' Category',
            'description' => 'All the category functions'
        ]);

        

        //Permissions
        $permission_all = [];

        //permission_role


        //====================USERS
        //permission_role
        $permission = Permission::create([
            'category_id' => $user_category->id,
            'name' => 'List user',
            'slug' => 'user.index',
            'description' => 'A user can list user'
        ]);
        //add permission to array
        $permission_all[] = $permission->id;
        $permission = Permission::create([
            'category_id' => $user_category->id,
            'name' => 'Show user',
            'slug' => 'user.show',
            'description' => 'A user can show user'
        ]);

        $permission_all[] = $permission->id;



        //add permission to array

        //add permission to array
        $permission_all[] = $permission->id;
        $permission = Permission::create([
            'category_id' => $user_category->id,
            'name' => 'Edit user',
            'slug' => 'user.edit',
            'description' => 'A user can edit user'
        ]);
        //add permission to array
        $permission_all[] = $permission->id;




        $permission = Permission::create([
            'category_id' => $user_category->id,
            'name' => 'Destroy user',
            'slug' => 'user.destroy',
            'description' => 'A user can destroy user'
        ]);


        //add permission to array
        $permission_all[] = $permission->id;




        //add global permission to array
        $permission = Permission::create([
            'category_id' => $user_category->id,
            'name' => 'edit own user',
            'slug' => 'userown.edit',
            'description' => 'A user can edit own user'
        ]);
        //add golbal permission to array
        $permission_all[] = $permission->id;



        $permission = Permission::create([
            'category_id' => $user_category->id,
            'name' => 'Show own user',
            'slug' => 'userown.show',
            'description' => 'A user can show own user'
        ]);
        $permission_all[] = $permission->id;


        //======================Role
        $permission = Permission::create([
            'category_id' => $role_category ->id,
            'name' => 'List role',
            'slug' => 'role.index',
            'description' => 'A user can list role'
        ]);
        //add permission to array
        $permission_all[] = $permission->id;
        $permission = Permission::create([
            'category_id' => $role_category ->id,
            'name' => 'Show role',
            'slug' => 'role.show',
            'description' => 'A user can show role'
        ]);
        //add permission to array
        $permission_all[] = $permission->id;
        $permission = Permission::create([
            'category_id' => $role_category ->id,
            'name' => 'Create role',
            'slug' => 'role.create',
            'description' => 'A user can create role'
        ]);
        //add permission to array
        $permission_all[] = $permission->id;
        $permission = Permission::create([
            'category_id' => $role_category ->id,
            'name' => 'Edit role',
            'slug' => 'role.edit',
            'description' => 'A user can edit role'
        ]);
        //add permission to array
        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'category_id' => $role_category ->id,
            'name' => 'Destroy role',
            'slug' => 'role.destroy',
            'description' => 'A user can destroy role'
        ]);


        //add permission to array
        $permission_all[] = $permission->id;



        //=====================Category===================


        $permission = Permission::create([
            'category_id' => $self_category->id,
            'name' => 'Index category',
            'slug' => 'category.index',
            'description' => 'All categories'
        ]);
        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'category_id' => $self_category->id,
            'name' => 'Create category',
            'slug' => 'category.create',
            'description' => 'A user can create a category'
        ]);
        $permission_all[] = $permission->id;




        $permission = Permission::create([
            'category_id' => $self_category->id,
            'name' => 'Show category',
            'slug' => 'category.show',
            'description' => 'Show category to an user'
        ]);
        $permission_all[] = $permission->id;



        $permission = Permission::create([
            'category_id' => $self_category->id,
            'name' => 'edit category',
            'slug' => 'category.edit',
            'description' => 'An user can edit category'
        ]);
        $permission_all[] = $permission->id;


        $permission = Permission::create([
            'category_id' => $self_category->id,
            'name' => 'destroy category',
            'slug' => 'category.destroy',
            'description' => 'An user can destroy category'
        ]);
        $permission_all[] = $permission->id;


        $roleadmin->permissions()->sync($permission_all);
    }
}
