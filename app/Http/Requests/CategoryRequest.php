<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        //Obtener el rol
        $category = $this->route('category');

        //Si el rol existe se puede quedar con los mismos datos pero no duplicar los datos de otros
        if ($category) {
            return [
                'name' => 'required|max:50|unique:categories,name,' . $category->id,
                'description' => 'required|max:50|unique:categories,description,' . $category->id,
            ];
        } else {
            return [
                'name' => 'required|max:50|unique:categories,name',
                'description' => 'required|max:50|unique:categories,description',
            ];
        }
    }
}
