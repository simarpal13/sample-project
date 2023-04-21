<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Set: authorization to true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'min:2', 'unique:categories,name'],
            'description' => ['required', 'min:2']
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] = ['required', Rule::unique('categories')->ignore($this->id)];
        }
        return $rules;
    }
}