<?php

namespace Tests\Feature\App\Http\Controllers\Backend\Role_User;

use App\Helpers\DefaultDataSeed;
use App\Role_User\Models\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;
use App\Role_User\Models\Role;
use App\Role_User\Models\Permission;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_category_test()
    {
        $this->withExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $response = $this->actingAs($user)->get('/category/create');

        Gate::authorize('haveaccess', 'category.create');


        $response->assertViewIs('category.create');
    }

    /** @test */
    public function store_category_test()
    {
        $this->withExceptionHandling();
        $name = 'Category 1 now';
        $description = 'New Category';

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $response = $this->actingAs($user)->post('/category', [
            'name' => $name,
            'description' => $description
        ]);

        Gate::authorize('haveaccess', 'category.create');


        $category = Category::latest('id')->first();

        $this->assertCount(3, Category::all());


        $this->assertEquals($category->name, $name);
        $this->assertEquals($category->description, $description);

        $response->assertRedirect('/category');
    }


    /** @test */
    public function list_of_categories_test()
    {
        $this->withExceptionHandling();
        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $response = $this->actingAs($user)->get('/category');

        Gate::authorize('haveaccess', 'category.index');

        $response->assertOk();

        $categories = Category::orderBy('id', 'Desc')->paginate(6);

        $response->assertViewIs('category.index');

        $response->assertViewHas('categories', $categories);
    }

    /** @test */

    public function show_category_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $category = Category::first();

        $response = $this->actingAs($user)->get('/category/' . $category->id);

        Gate::authorize('haveaccess', 'category.show');

        $response->assertOk();

        $response->assertViewIs('category.show');
        $response->assertViewHas('category', $category);
    }


    /** @test */
    public function edit_category_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $category = Category::first();

        $response = $this->actingAs($user)->get('/category/' . $category->id . '/edit');

        Gate::authorize('haveaccess', 'category.edit');

        $response->assertOk();

        $response->assertViewIs('category.edit');
        $response->assertViewHas('category', $category);
    }

    /** @test */
    public function update_category_test()
    {
        $this->withoutExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $category = Category::first();

        $name_update = 'User';
        $description_update = 'New module User';

        $response = $this->actingAs($user)->put('/category/' . $category->id, [
            'name' => $name_update,
            'description' => $description_update
        ]);

        $this->assertCount(2, Category::all());

        $category = $category->fresh();

        $this->assertEquals($category->name, $name_update);
        $this->assertEquals($category->description, $description_update);

        $response->assertRedirect('/category');
    }


    /** @test */
    public function delete_category_test()
    {
        $this->withExceptionHandling();

        DefaultDataSeed::default_data_seed();

        $user = User::first();

        $category = Category::first();

        $response = $this->actingAs($user)->delete('/category/' . $category->id);

        Gate::authorize('haveaccess', 'category.destroy');

        $this->assertCount(1, Category::all());


        $response->assertRedirect('/category');
    }
}
