<?php

namespace App\Validators;

use App\Models\User;
use App\Rules\CnpjRule;
use Illuminate\Support\Facades\Validator;

/**
 * Class AccountValidator
 * @package App\Validators
 */
class AccountValidator implements ValidatorInterface
{
    /**
     * @param array $data
     */
    public static function validateToCreate(array $data)
    {
        Validator::make($data, [

        ])->validate();
    }

    /**
     * @param array $data
     * @param int|null $account_id
     */
    public static function validateToUpdate(array $data, int $account_id = null)
    {
        Validator::make($data, [

        ])->validate();
    }

    /**
     * @param array $data
     */
    public static function validateToCreateGuest(array $data)
    {
        Validator::make($data, [
            'user_name' => 'required|string|max:255|min:3',
            'user_email' => 'required|email|max:255|min:3|unique:' . (new User())->getTable() . ',email',
            'account_name' => 'required|string|max:255|min:3',
            'user_password' => 'required|min:6|max:255',
            'account_cnpj' => ['bail', 'required', 'min:14', 'max:18', new CnpjRule]
        ])->validate();
    }
}
