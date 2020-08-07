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
     * @param array|null $data
     * @return string[]
     */
    public static function validateToCreate(array $data = null): array
    {
        return [
            'name' => 'required|min:3|max:255|string',
            'email' => 'required|email|min:3|max:255|unique:' . (new User())->getTable(),
            'password' => 'required|string|min:6|max:500',
            'account_id' => 'required|integer|exists:' . (new Account())->getTable() . ',id',
            'permission' => 'required|integer'
        ];
    }

    /**
     * @param array $data
     * @param int $id
     * @return array
     */
    public static function validateToUpdate(array $data, int $id): array
    {
        return [
            'name' => 'sometimes|string|min:3|max:255',
            'email' =>
                'sometimes|email|min:3|max:255|unique:' .
                (new User())->getTable() . ',email,' . $id,
            'password' => 'sometimes|string|min:6|max:500',
            'account_id' => 'sometimes|integer|exists:' . (new Account())->getTable() . ',id',
            'permission' => 'sometimes|integer'
        ];
    }
}
