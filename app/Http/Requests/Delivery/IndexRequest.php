<?php

namespace App\Http\Requests\Delivery;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'page' => ['sometimes', 'required', 'integer', 'min:1'],
            'pageSize' => ['sometimes', 'required', 'integer', 'min:1', 'max:50'],
            'filter[status]' => ['sometimes', 'nullable', 'string', 'htmlclean'],
            'sort' => ['sometimes', 'nullable', 'string', 'htmlclean'],
            'include' => ['sometimes', 'nullable', 'string', 'htmlclean'],
        ];
    }
}
