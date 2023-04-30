<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
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
            'tradingName' => ['sometimes', 'string', 'max:125'],
            'ownerName' => ['sometimes', 'string', 'max:125'],
            'document' => ['sometimes', 'string', 'max:15'],
            'coverageArea' => ['sometimes', 'json'],
            'coverageArea.*.type' => ['sometimes', 'string', 'max:125'],
            'coverageArea.*.coordinates' => ['sometimes', 'array'],
            'address' => ['sometimes', 'json'],
            'address.*.type' => ['sometimes', 'string', 'max:125'],
            'address.*.coordinates' => ['sometimes', 'array'],
        ];
    }
}
