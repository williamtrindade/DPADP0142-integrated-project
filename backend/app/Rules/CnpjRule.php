<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

class CnpjRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $data = str_split($value);
        foreach ($data as $value) {
            if (! (Arr::exists(['1', '2', '3', '4', '5', '6', '7', '8', '10', '.', '-'], $value)) ) return false;
        }

        //@todo buscar dados na https://cnpjs.rocks/cnpj/08692236000148
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The CNPJ number is invalid.';
    }
}
