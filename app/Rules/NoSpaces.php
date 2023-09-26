<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule; // Import the Rule interface


class NoSpaces implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Check if the value contains spaces
        return !preg_match('/\s/', $value);
    }

    public function message()
    {
        return 'The :attribute cannot contain spaces.';
    }
}
