<?php

namespace App\Http\Requests\Role_User\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class RoleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('haveaccess', 'role.create');
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            return [
                //Create
                'name' => 'required|max:50|unique:roles,name',
                'slug' => 'required|max:50|unique:roles,slug',
                'full_access' => 'required|in:yes,no',
            ];
        
    }
}
