<?php

namespace App\Validators;

use App\Models\User;

/**
 * Class UserValidator
 * @package App\Validators
 */
class UserValidator implements ValidatorInterface
{
    /**
     * @return string[]
     */
    public static function validateToCreate(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:' . (new User())->getTable(),
            'password' => 'required'
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
