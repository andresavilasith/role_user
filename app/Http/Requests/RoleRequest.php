<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Uobtener el rol
        $role = $this->route('role');

        //Si el rol existe se puede quedar con los mismos datos pero no duplicar los datos de otros
        if ($role) {
            return [
                'name' => 'required|max:50|unique:roles,name,' . $role->id,
                'slug' => 'required|max:50|unique:roles,slug,' . $role->id,
                'full-access' => 'required|in:yes,no',
            ];
        } else {
            return [
                'name' => 'required|max:50|unique:roles,name',
                'slug' => 'required|max:50|unique:roles,slug',
                'full-access' => 'required|in:yes,no',
            ];
        }
    }
}
