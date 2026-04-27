<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreShoeRequest extends FormRequest
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
            'sku' => 'required|string|max:255',
            'category' => 'sometimes|exists:shoe_categories,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'base_price' => 'sometimes|numeric|min:0',
            'color' => 'required|string|max:255',
            'size' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'description' => 'sometimes|nullable|string|max:255',
        ];
    }
}
