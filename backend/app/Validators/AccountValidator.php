<?php

namespace App\Validators;

use App\Models\Account;
use App\Models\User;
use App\Rules\CnpjRule;
use App\Validators\Base\ValidatorInterface;

/**
 * Class AccountValidator
 * @package App\Validators
 */
class AccountValidator implements ValidatorInterface
{
    /**
     * @param array $data
     * @return array
     */
    public static function validateToCreate(array $data): array
    {
        $account_table = (new Account())->getTable();
        return [
            'name'       => 'required|min:3|max:255',
            'cnpj'       => ['required', 'min:14', 'max:14' , 'unique:' . $account_table, new CnpjRule],
            'address'    => 'sometimes|string|min:3|max:255',
            'cep'        => 'sometimes|string|min:8|max:8',
            'manager_id' => 'sometimes|exists:' . (new User())->getTable() . ',id',
            'phone'      => 'required|min:10|max:15|unique:' . (new Account())->getTable() . ',phone',
        ];
    }

    /**
     * @param array $data
     * @param int $id
     * @return array
     */
    public static function validateToUpdate(array $data, int $id): array
    {
        $account_table = (new Account())->getTable();
        return [
            'name'       => 'sometimes|min:3|max:255|string',
            'cnpj'       => [
                'sometimes',
                'min:14',
                'max:14',
                'unique:' . $account_table . ',cnpj,' . $id,
                new CnpjRule
            ],
            'address'    => 'sometimes|string|min:3|max:255',
            'cep'        => 'sometimes|string|min:8|max:8',
            'manager_id' => 'sometimes|exists:' . (new User())->getTable() . ',id',
            'phone'      => 'sometimes|min:10|max:15|unique:' . (new Account())->getTable() . ',phone,' . $id,
        ];
    }
}
