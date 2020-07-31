<?php

namespace App\Validators;

use App\Models\Account;
use App\Models\User;

/**
 * Class UserValidator
 * @package App\Validators
 */
class UserValidator implements ValidatorInterface
{
    /**
     * @param int|null $account_id
     * @return string[]
     */
    public static function validateToCreate(int $account_id = null): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:' . (new User())->getTable(),
            'password' => 'required',
            'account_id' => 'required|exists:' . (new Account())->getTable(),
        ];
    }

    /**
     * @param int|null $account_id
     * @return array
     */
    public static function validateToUpdate(int $account_id = null): array
    {
        return [

        ];
    }
}
