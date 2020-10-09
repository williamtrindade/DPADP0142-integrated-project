<?php

namespace App\Validators;

use App\Models\Address;
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
            'lat'     => ['required', 'string', 'regex:' . Address::LAT_REGX],
            'lng'     => ['required', 'string', 'regex:' . Address::LNG_REGX],
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
