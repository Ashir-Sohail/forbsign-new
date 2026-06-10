<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check(); // Or just return true if no guard used
    }

    public function rules(): array
    {
        // Check if this is update by checking route param (id or model)
        $brandId = $this->route('id') ?? optional($this->brand)->id;

        return [
            'name' => 'required|unique:brands,name,' . $brandId,
            'website_id'=>'required|exists:websites,id',
            'image' => $this->isMethod('post')
                ? 'image|mimes:jpg,png,jpeg|max:2096'
                : 'nullable|image|mimes:jpg,png,jpeg|max:2096',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_url' => 'required',
            'meta_description' => 'required',
        ];
    }
}
