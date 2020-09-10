<?php

namespace App\Http\Controllers\Backend\Role_User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Role_User\Models\Permission;
use App\Role_User\Models\Role;
use Illuminate\Http\Request;
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

        $roles = Role::orderBy('id', 'Desc')->paginate(6);

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess', 'role.create');
        $permissions = Permission::all();
        return view('role.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Gate::authorize('haveaccess', 'role.create');

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

        $permissions = Permission::all();

        $permission_role = [];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }

        return view('role.show', [
            'role' => $role,
            'permissions' => $permissions,
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

        $permission_role = [];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }

        return view('role.edit', [
            'role' => $role,
            'permissions' => $permissions,
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
    public function update(RoleRequest $request, Role $role)
    {
        Gate::authorize('haveaccess', 'role.edit');

        $role->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'full_access' => $request->full_access
        ]);


        if ($request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        }


        return redirect()->route('role.show', $role->id)->with('status_success', 'Role updated successfully');
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
