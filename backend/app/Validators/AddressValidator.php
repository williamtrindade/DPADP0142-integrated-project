<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class AddressValidator
 * @package App\Validators
 */
class AddressValidator
{
    /**
     * @return string[]
     */
    private function rulesToUpdateAddress(): array
    {
        return [
            'lat'     => ['required', 'string', 'regex:^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$^'],
            'lng'     => ['required', 'string', 'regex:^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$^   '],
            'address' => 'required|string'
        ];
    }

    /**
     * @param array $data
     * @throws ValidationException
     */
    public function validateAddress(array $data)
    {
        Validator::make($data, $this->rulesToUpdateAddress())->validate();
    }
}
