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
            'isWFG' => ['boolean'], // Add the boolean validation rule for isWFG
            'isWRT' => ['boolean'], // Add the boolean validation rule for isWRT
            'isWRM' => ['boolean'], // Add the boolean validation rule for isWRM
            'isHRG' => ['boolean'], // Add the boolean validation rule for isHRG
            'isDGS' => ['boolean'], // Add the boolean validation rule for isDGS
            'isSLS' => ['boolean'], // Add the boolean validation rule for isSLS
            'isMKT' => ['boolean'], // Add the boolean validation rule for isMKT
            'isDEL' => ['boolean'], // Add the boolean validation rule for isDEL
            'isPRD' => ['boolean'], // Add the boolean validation rule for isPRD
            'isPPI' => ['boolean'], // Add the boolean validation rule for isPPI
            'isRPR' => ['boolean'], // Add the boolean validation rule for isRPR
            'isPCH' => ['boolean'], // Add the boolean validation rule for isPCH
            'isQCT' => ['boolean'], // Add the boolean validation rule for isQCT
        ];
    }
}
