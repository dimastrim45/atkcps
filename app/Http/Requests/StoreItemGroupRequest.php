<?php

namespace App\Http\Requests;
//
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\ItemGroup;

class StoreItemGroupRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique((new ItemGroup)->getTable(), 'name'),],
            'code' => ['required', 'string', Rule::unique((new ItemGroup)->getTable(), 'code'),],
            'isENG' => ['boolean'], // Add the boolean validation rule for isENG
            'isFAT' => ['boolean'], // Add the boolean validation rule for isFAT
            'isGFG' => ['boolean'], // Add the boolean validation rule for isGFG
            'isGRT' => ['boolean'], // Add the boolean validation rule for isGRT
            'isGRM' => ['boolean'], // Add the boolean validation rule for isGRM
            'isHRGA' => ['boolean'], // Add the boolean validation rule for isHRGA
            'isDGSL' => ['boolean'], // Add the boolean validation rule for isDGSL
            'isSLS' => ['boolean'], // Add the boolean validation rule for isSLS
            'isMRKT' => ['boolean'], // Add the boolean validation rule for isMRKT
            'isDEL' => ['boolean'], // Add the boolean validation rule for isDEL
            'isPROD' => ['boolean'], // Add the boolean validation rule for isPROD
            'isPPIC' => ['boolean'], // Add the boolean validation rule for isPPIC
            'isRPR' => ['boolean'], // Add the boolean validation rule for isRPR
            'isPRCH' => ['boolean'], // Add the boolean validation rule for isPRCH
        ];
    }
}
