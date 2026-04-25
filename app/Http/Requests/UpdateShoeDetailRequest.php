<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShoeDetailRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => 'sometimes|exists:shoe_categories,id',
            'brand' => 'sometimes|string|max:255',
            'model' => 'sometimes|string|max:255',
            'base_price' => 'sometimes|numeric|min:0',
            'description' => 'sometimes|nullable|string|max:255',
            'promo_descount' => 'sometimes|nullable|integer|min:0|max:100',
        ];
    }
}
