<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
        $itemId = $this->input('item_id'); // Get the item_id from the input

        return [
            //
            'name' => ['required', 'string', 'max:255', Rule::unique('items', 'name')->ignore($itemId),],
            'min_qty' => ['nullable', 'integer'],
            'uom' => ['required'],
            'price' => ['required', 'integer'],
            'expdate' => ['nullable'],
            'status' => ['required'],
            'itemgroup_id' => ['required'],
        ];
    }
}
