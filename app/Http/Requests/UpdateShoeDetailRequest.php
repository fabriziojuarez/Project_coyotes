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
            'category' => 'required|exists:shoe_categories,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'description' => 'required|nullable|string|max:255',
            'promo_descount' => 'sometimes|nullable|integer|min:0|max:100',
            'is_discontinued' => 'required|boolean',
        ];
    }
}
