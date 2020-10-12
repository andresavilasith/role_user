<?php

namespace App\Http\Controllers\Backend\Role_User;

use App\Http\Controllers\Controller;
use App\Models\Role_User\Category;
use App\Models\Role_User\Permission;
use App\Models\Role_User\Role;
use App\Http\Requests\Role_User\Role\RoleStoreRequest;
use App\Http\Requests\Role_User\Role\RoleUpdateRequest;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'role.index');

        $roles = Role::all();

        return view('role_user.role.index', compact('roles'))->with('status_success', 'Role updated successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess', 'role.create');
     
        $categories = Category::with('permissions')->get();
        return view('role_user.role.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'full_access' => $request->full_access
        ]);


        if ($request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        }


        return redirect()->route('role.index')->with('status_success', 'Role updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        Gate::authorize('haveaccess', 'role.show');

        $categories = Category::with('permissions')->get();


        $permission_role = [];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }


        return view('role_user.role.show', [
            'role' => $role,
            'categories' => $categories,
            'permission_role' => $permission_role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('haveaccess', 'role.edit');

        $permissions = Permission::all();

        $categories = Category::with('permissions')->get();

        $permission_role = [];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }

        return view('role_user.role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'categories' => $categories,
            'permission_role' => $permission_role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'full_access' => $request->full_access
        ]);


        if ($request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        }


        return redirect()->route('role.index')->with('status_success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('haveaccess', 'role.destroy');

        $role->delete();

        return redirect()->route('role.index')->with('status_success', 'Role deleted successfully');
    }
}
