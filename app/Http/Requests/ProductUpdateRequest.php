<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:products,name,' . $this->route('id'),
            'featured_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2096',
            'short_description' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'meta_url' => 'required',
            'current_price' => 'required|numeric',
            'previous_price' => 'nullable|numeric',
            'cat_ids' => 'required|array',
            'cat_ids.*' => 'required|integer|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'total_stock' => 'required',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpg,png,jpeg|max:2096',
        ];
    }
}
