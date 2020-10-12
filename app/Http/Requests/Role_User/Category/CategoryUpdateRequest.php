<?php

namespace App\Http\Requests\Role_User\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Gate::authorize('haveaccess', 'category.edit');
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
        $category = $this->route('category');

        //Si el rol existe se puede quedar con los mismos datos pero no duplicar los datos de otros
        if ($category) {
            return [
                'name' => 'required|max:50|unique:categories,name,' . $category->id,
                'description' => 'required|max:50|unique:categories,description,' . $category->id,
            ];
        }
    }
}
