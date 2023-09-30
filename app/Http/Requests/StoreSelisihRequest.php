<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSelisihRequest extends FormRequest
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
            'item_id.*' => 'required|exists:items,id', // Validate each item_id in the array to exist in the "items" table
            'uom.*' => 'required|string|max:255',
            'price.*' => 'required|numeric|min:0',
            'qty.*' => 'required|integer|min:1',
            'remarks' => 'required|string|max:255',
        ];
    }
}
