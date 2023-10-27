<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangMasukRequest extends FormRequest
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
            'nomorpo' => 'required|string|max:255',
            'item_id.*' => 'required|exists:items,id', // Validate each item_id in the array to exist in the "items" table
            'uom.*' => 'required|string|max:255',
            'price.*' => 'required|numeric|min:0',
            'subtotal.*' => 'required|numeric|min:0',
            'expdate.*' => 'nullable|date',
            'qty.*' => 'required|integer|min:1',
            'remarks' => 'nullable|string|max:255',
        ];
    }
}
