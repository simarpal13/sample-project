<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required',
                'string',
                'max:50', Rule::unique('products')->where(function ($query) {
                    return $query->where('category_id', $this->category_id)
                        ->where('subcategory_id', $this->subcategory_id);
                })
            ],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric'],
            'image' => ['required', 'mimes:jpg,png'],
            'description' => ['required'],
            'category_id' => ['required'],
            'subcategory_id' => ['required'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['name'] = ['required', Rule::unique('products')->ignore($this->product_id)];
            $rules['image'] = ['sometimes'];
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'price.required' => 'Price should be valid number',
            'discount.required' => 'Discount should be valid number',
            'image.required' => 'File must be a valid image',
            'description.required' => 'Description is required',
            'category_id.required' => 'Category is required',
            'subcategory_id.required' => 'Subcategory is required',
        ];
    }
}
