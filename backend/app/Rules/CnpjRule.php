<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

/**
 * Class CnpjRule
 * @package App\Rules
 */
class CnpjRule implements Rule
{
    public const INVALID_FORMAT = 'O formato do CNPJ é inválido';
    public const INVALID_NUMBER = 'O número de CNPJ não existe';
    public const VALID_CHARS = ['.', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', '/',];

    /** @var string $error */
    public $error;

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
        foreach ($data as $char) {
            if (! (Arr::exists(self::VALID_CHARS, $char)) && ($char != '.') && ($char != '/') && ($char != '-')) {
                $this->error = self::INVALID_FORMAT;
                return false;
            }
        }

        // buscar dados na https://www.receitaws.com.br/v1/cnpj/
        $response = Http::get('https://www.receitaws.com.br/v1/cnpj/' . str_replace(['/', '.', '-'], '', $value));
        if (json_decode($response->body())->status == 'ERROR') {
            $this->error = self::INVALID_NUMBER;
            return false;
        } else if(json_decode($response->body())->status == 'OK') {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error;
    }
}
