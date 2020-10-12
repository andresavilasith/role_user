<?php

namespace App\Http\Requests\Role_User\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class PermissionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('haveaccess', 'permission.edit');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Obtener el rol
        $permission = $this->route('permission');
 
        //Si el rol existe se puede quedar con los mismos datos pero no duplicar los datos de otros
        if ($permission) {
            return [
                'name' => 'required|max:50|unique:permissions,name,' . $permission->id,
                'slug' => 'required|max:50|unique:permissions,slug,' . $permission->id,
                'description' => 'required|max:50|unique:permissions,description,' . $permission->id,
            ];
        }
    }
}
