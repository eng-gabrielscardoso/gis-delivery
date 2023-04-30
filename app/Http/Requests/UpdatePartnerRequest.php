<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
            'tradingName' => ['sometimes', 'string', 'max:125', 'nullable'],
            'ownerName' => ['sometimes', 'string', 'max:125', 'nullable'],
            'document' => ['sometimes', 'string', 'max:15', 'nullable'],
            'coverageArea' => ['sometimes', 'json', 'nullable'],
            'coverageArea.*.type' => ['sometimes', 'string', 'max:125'],
            'coverageArea.*.coordinates' => ['sometimes', 'array'],
            'address' => ['sometimes', 'json', 'nullable'],
            'address.*.type' => ['sometimes', 'string', 'max:125'],
            'address.*.coordinates' => ['sometimes', 'array'],
        ];
    }
}
