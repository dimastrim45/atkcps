<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermintaanRequest extends FormRequest
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
            'item_id.*'   => 'required|exists:items,id',
            'qty.*'       => 'required|numeric|min:0',
            'price.*'     => 'required|numeric|min:0',
            'expdate.*'   => 'nullable|date',
            'remarks'     => 'nullable|string|max:255',
            'duwdate.*'   => 'required|date',
        ];
    }
}
