<?php

namespace App\Http\Controllers\Backend\Role_User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Role_User\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'category.index');

        $categories = Category::orderBy('id', 'Desc')->paginate(6);

        return view('role_user.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess', 'category.create');
        
        return view('role_user.category.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Gate::authorize('haveaccess', 'category.create');
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        Gate::authorize('haveaccess', 'category.show');

        return view('role_user.category.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        Gate::authorize('haveaccess', 'category.edit');
        return view('role_user.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        Gate::authorize('haveaccess', 'category.edit');
        $category->update([
            'name'=>$request->name,
            'description'=>$request->description,
            ]);

            return redirect('/category');
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Category $category)
        {
            
            Gate::authorize('haveaccess', 'category.destroy');

            $category->delete();

            return redirect('/category');
    }
}
