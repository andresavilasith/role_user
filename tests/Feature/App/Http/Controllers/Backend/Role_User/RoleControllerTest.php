<?php

namespace Tests\Feature\App\Http\Controllers\Backend\Role_User;

use App\Helpers\DefaultDataSeed;
use App\Models\Role_User\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Gate;
use App\Models\Role_User\Role;
use App\Models\Role_User\Permission;
use App\Models\User;

class RoleControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function create_role_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $response = $this->actingAs($user)->get('/role/create');

        Gate::authorize('haveaccess', 'role.create');

        $categories = Category::with('permissions')->get();
        
        $response->assertOk();

        $response->assertViewIs('role_user.role.create');
        $response->assertViewHas('categories', $categories);
    }

    /** @test */
    public function store_role_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $name = 'ccontent';
        $slug = 'ccontent';
        $description = 'Create content';
        $full_access = 'no';

        $five_permissions = Permission::limit(5)->get();

        $response = $this->actingAs($user)->post('/role', [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'full_access' => $full_access
        ]);


        Gate::authorize('haveaccess', 'role.create');

        $this->assertCount(2, Role::all());
        $role = Role::latest('id')->first();


        $role->permissions()->sync($five_permissions);


        $this->assertEquals($role->name, $name);
        $this->assertEquals($role->slug, $slug);
        $this->assertEquals($role->description, $description);
        $this->assertEquals($role->full_access, $full_access);

        $response->assertRedirect('/role');
    }

    /** @test */
    public function list_of_roles_test()
    {

        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $response = $this->actingAs($user)->get('/role');

        Gate::authorize('haveaccess', 'role.index');

        $response->assertOk();

        $roles = Role::all();

        $response->assertViewIs('role_user.role.index');

        $response->assertViewHas('roles', $roles);
    }

    /** @test */
    public function show_role_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $role = Role::first();

        $response = $this->actingAs($user)->get('/role/' . $role->id);

        Gate::authorize('haveaccess', 'role.show');

        $categories = Category::with('permissions')->get();


        $permission_role = [];
      
        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }
        


        $response->assertOk();

        $response->assertViewIs('role_user.role.show');
        $response->assertViewHas('role', $role);
        $response->assertViewHas('categories', $categories);
        $response->assertViewHas('permission_role', $permission_role);
    }



    /** @test */
    public function edit_role_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $role = Role::first();

        $response = $this->actingAs($user)->get('/role/' . $role->id . '/edit');

        Gate::authorize('haveaccess', 'role.edit');

        $permissions = Permission::all();

        $categories = Category::with('permissions')->get();

        $permission_role = array();

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }


        $response->assertOk();

        $response->assertViewIs('role_user.role.edit');
        $response->assertViewHas('role', $role);
        $response->assertViewHas('permissions', $permissions);
        $response->assertViewHas('categories', $categories);
        $response->assertViewHas('permission_role', $permission_role);
    }


    /** @test */
    public function update_role_test()
    {
        $this->withExceptionHandling();

        DefaultDataSeed::default_data_seed();


        $user = User::first();
        $role = Role::first();

        $response = $this->actingAs($user)->put('/role/' . $role->id, [
            'name' => 'role edit',
            'slug' => 'role.edit',
            'description' => 'new role',
            'full_access' => 'no'
        ]);

        Gate::authorize('haveaccess', 'role.edit');


        Permission::factory()->count(9)->make();
        $last_permission = Permission::find(10);

        $role->permissions()->sync($last_permission);

        $this->assertCount(1, Role::all());

        $role = $role->fresh();

        $this->assertEquals($role->name, 'role edit');
        $this->assertEquals($role->slug, 'role.edit');
        $this->assertEquals($role->description, 'new role');
        $this->assertEquals($role->full_access, 'no');

        $response->assertRedirect('/role');
    }

    /** @test */

    public function delete_role_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();
        $role = Role::first();

        $response = $this->actingAs($user)->delete('/role/' . $role->id);

        Gate::authorize('haveaccess', 'role.destroy');

        $this->assertCount(0, Role::all());

        $response->assertRedirect('/role');
    }
}
