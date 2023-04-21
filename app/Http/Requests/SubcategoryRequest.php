<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubcategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        /* When Subcategory Name and Category already exist
            * Then mention a unique name for subcategory
            */
        $rules = [
            'name' => [
                'required', 'string', 'max:50', "unique:subcategories,name"
            ],
            'description' => ['required', 'min:2'],
            'category_id' => ['required']
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] = ['required', Rule::unique('subcategories')->ignore($this->id)];
        }
        return $rules;
    }
}
