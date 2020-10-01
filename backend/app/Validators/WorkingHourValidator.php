<?php

namespace App\Validators;

use App\Models\Account;
use App\Models\User;
use App\Validators\Base\ValidatorInterface;

/**
 * Class WorkingHourValidator
 * @package App\Validators
 */
class WorkingHourValidator implements ValidatorInterface
{
    /**
     * @param array $data
     * @return array
     */
    public static function validateToCreate(array $data): array
    {
        return [
            'account_id'  => 'required|integer|exists:' . (new Account())->getTable() . ',id',
            'user_id'     => 'required|integer|exists:' . (new User())->getTable() . ',id',
            'name'        => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:255',
        ];
    }

    /**
     * @param array $data
     * @param int $id
     * @return array
     */
    public static function validateToUpdate(array $data, int $id): array
    {
        return [];
    }
}
