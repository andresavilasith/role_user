<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        //Obtener el usuario
        $user = $this->route('user');

    //Comprobar si el usuario existe
        if ($user) {
            return [
                'name' => 'required|max:50|unique:users,name,' . $user->id,
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $user->id],
                'img' => 'string'
            ];
        }
    }
}
