<?php

namespace App\Http\Controllers\Backend\Role_User;

use App\Http\Controllers\Controller;
use App\Models\Role_User\Category;
use App\Models\Role_User\Permission;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Role_User\Permission\PermissionStoreRequest;
use App\Http\Requests\Role_User\Permission\PermissionUpdateRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'permission.index');

        $permissions = Permission::all();

        return view('role_user.permission.index', compact('permissions'))->with('status_success', 'Permission updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess', 'permission.create');

        $categories = Category::all();

        return view('role_user.permission.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {

        Permission::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        return redirect('/permission');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        Gate::authorize('haveaccess', 'permission.show');

        $categories = Category::all();

        return view('role_user.permission.show', [
            'permission' => $permission,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        Gate::authorize('haveaccess', 'permission.edit');
        $categories = Category::all();
        return view('role_user.permission.edit', [
            'permission' => $permission,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        
        $permission->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description
        ]);

        return redirect('/permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        Gate::authorize('haveaccess', 'permission.destroy');

        $permission->delete();

        return redirect('/permission');
    }
}
