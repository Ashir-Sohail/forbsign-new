<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        // dd('authorize method is running');
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
            'name' => 'required|unique:products',
            'featured_image' => 'required|image|mimes:jpg,png,jpeg|max:2096',
            'short_description' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'meta_url' => 'required',
            'current_price' => 'required|numeric',
            'previous_price' => 'nullable|numeric',
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'total_stock' => 'required',
            // 'sizes' => 'required|array',
            // 'sizes.*' => 'required|string',
            'prices' => 'nullable|array',
            'prices.*' => 'nullable|numeric',
            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpg,png,jpeg|max:2096',
            'informative' => 'required|in:0,1',
        ];
    }
}
