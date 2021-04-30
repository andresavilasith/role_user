<?php

namespace Tests\Feature\App\Http\Controllers\Backend\Role_User;

use App\Helpers\DefaultDataSeed;
use App\Models\Role_User\Category;
use App\Models\Role_User\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_permission_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $response = $this->actingAs($user)->get('/permission/create');

        Gate::authorize('haveaccess', 'permission.create');

        $categories = Category::all();

        $response->assertViewIs('role_user.permission.create');
        $response->assertViewHas('categories', $categories);
    }

    /** @test */
    public function store_permission_test()
    {
        $this->withExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $category = Category::first();

        $category_id = $category->id;
        $name = 'Ur all delete';
        $slug = 'us.destroyyy';
        $description = 'others usersss';

        $response = $this->actingAs($user)->post('/permission', [
            'category_id' => $category_id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description
        ]);

        Gate::authorize('haveaccess', 'permission.create');


        $this->assertCount(3, Permission::all());

        $permission = Permission::latest('id')->first();

        $this->assertEquals($permission->category_id, $category_id);
        $this->assertEquals($permission->name, $name);
        $this->assertEquals($permission->slug, $slug);
        $this->assertEquals($permission->description, $description);


        $response->assertRedirect('/permission');
    }

    /** @test */

    public function list_of_permissions_test()
    {
        $this->withExceptionHandling();
        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $response = $this->actingAs($user)->get('/permission');

        Gate::authorize('haveaccess', 'permission.index');

        $response->assertOk();

        $permissions = Permission::all();

        $response->assertViewIs('role_user.permission.index');
        $response->assertViewHas('permissions', $permissions);
    }

    /** @test */
    public function show_permission_test()
    {
        $this->withExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $permission = Permission::first();

        $categories = Category::all();

        $response = $this->actingAs($user)->get('/permission/' . $permission->id);

        Gate::authorize('haveaccess', 'permission.show');

        $response->assertViewIs('role_user.permission.show');
        $response->assertViewHas('permission', $permission);
        $response->assertViewHas('categories', $categories);
    }

    /** @test */
    public function edit_permission_test()
    {
        $this->withExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $categories = Category::all();

        $permission = Permission::first();

        $response = $this->actingAs($user)->get('/permission/' . $permission->id . '/edit');

        Gate::authorize('haveaccess', 'permission.edit');

        $response->assertViewIs('role_user.permission.edit');
        $response->assertViewHas('permission', $permission);
        $response->assertViewHas('categories', $categories);
    }

    /** @test */
    public function update_permission_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $category = Category::latest('id')->first();



        $permission = Permission::latest('id')->first();


        $category_id = $category->id;
        $name = 'User enw alsls';
        $slug = 'user.edited';
        $description = 'A user can editedd others';

        $response = $this->actingAs($user)->put('/permission/' . $permission->id, [
            'category_id' => $category_id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description
        ]);

        Gate::authorize('haveaccess', 'category.edit');

        $this->assertCount(2, Permission::all());

        $permission = $permission->fresh();

        $this->assertEquals($permission->category_id, $category_id);
        $this->assertEquals($permission->name, $name);
        $this->assertEquals($permission->slug, $slug);
        $this->assertEquals($permission->description, $description);

        $response->assertRedirect('/permission');
    }


    /** @test */
    public function delete_permission_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $permission = Permission::latest('id')->first();

        $response = $this->actingAs($user)->delete('/permission/' . $permission->id);

        Gate::authorize('haveaccess', 'permission.destroy');

        $this->assertCount(1, Permission::all());

        $response->assertRedirect('/permission');
    }
}
