<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'trading_name' => ['sometimes', 'string', 'max:125'],
            'owner_name' => ['sometimes', 'string', 'max:125'],
            'document' => ['sometimes', 'string', 'max:18'],
            'coverage_area.type' => ['sometimes', 'string', 'max:125'],
            'coverage_area.coordinates' => ['sometimes', 'array'],
            'address.type' => ['sometimes', 'string', 'max:125'],
            'address.coordinates' => ['sometimes', 'array'],
        ];
    }
}
