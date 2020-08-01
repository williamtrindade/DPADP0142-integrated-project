<?php

namespace App\Validators;

use App\Models\Account;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

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
            'name' => 'required|string',
            'email' => 'required|email|unique:' . (new User())->getTable(),
            'password' => 'required|string',
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
            'name' => 'sometimes|string|min:3|max:250   ',
            'email' =>
                'sometimes|email|unique:' .
                (new User())->getTable() . ',email,' .
                app(UserRepositoryInterface::class)->read($id)->id,
            'password' => 'sometimes|string',
            'account_id' => 'sometimes|integer|exists:' . (new Account())->getTable() . ',id',
            'permission' => 'sometimes|integer'
        ];
    }
}
