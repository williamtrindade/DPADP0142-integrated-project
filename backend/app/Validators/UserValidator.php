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
            'name' => 'required|string',
            'email' => 'required|email|unique:' . (new User())->getTable(),
            'password' => 'required|string',
            'account_id' => 'required|integer|exists:' . (new Account())->getTable() . ',id',
            'permission' => 'required|integer'
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
