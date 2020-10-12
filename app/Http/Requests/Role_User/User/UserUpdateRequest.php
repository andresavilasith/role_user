<?php

namespace App\Http\Requests\Role_User\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->route('user');
        Gate::authorize('update', [$user, ['user.edit', 'userown.edit']]);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Obtener el usuario
        $user = $this->route('user');
        
    //Comprobar si el usuario existe
        if ($user) {

            return [
                'name' => 'required|max:50|unique:users,name,' . $user->id,
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id]
            ];
        }
    }
}
