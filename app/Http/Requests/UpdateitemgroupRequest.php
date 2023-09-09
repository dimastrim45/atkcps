<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\ItemGroup;

class UpdateItemGroupRequest extends FormRequest
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
        // dd($this->route('itemgroup'));
        $itemGroupCode = $this->route('itemgroup');
        $itemGroupId = ItemGroup::where('code', $itemGroupCode)->value('id');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('item_groups', 'name')->ignore($itemGroupId),],
            'code' => ['required', 'string', Rule::unique('item_groups', 'code')->ignore($itemGroupId),],
        ];
    }
}
