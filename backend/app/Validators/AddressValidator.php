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
            'lat' => 'required|string',
            'lng' => 'required|string',
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
