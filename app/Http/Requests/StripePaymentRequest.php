<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StripePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'address1'    => 'required|string|max:255',
            'address2'    => 'nullable|string|max:255',
            'contact'     => 'required|string|max:20',
            'city'        => 'required|string|max:100',
            'zip_code'    => 'required|string|max:20',
            'check_input' => 'nullable|string|max:255',
            'stripeToken' => 'required|string',
            'price'       => 'required|numeric|min:1',
        ];
    }
}
