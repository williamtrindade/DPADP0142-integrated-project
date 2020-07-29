<?php

namespace App\Validators;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserValidator
 * @package App\Validators
 */
class UserValidator implements ValidatorInterface
{
    /**
     * @param array $data
     */
    public static function validateToCreate(array $data)
    {
        Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:' . (new User())->getTable(),
            'password' => 'required'
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
}
