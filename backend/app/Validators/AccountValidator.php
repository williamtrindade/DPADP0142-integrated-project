<?php

namespace App\Validators;

use App\Models\Account;
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
     * @return array
     */
    public static function validateToCreate(array $data): array
    {
        $account_table = (new Account())->getTable();
        return [
            'name'       => 'required|min:3|max:255',
            'cnpj'       => ['required', 'min:14', 'max:18' , 'unique:' . $account_table, new CnpjRule],
            'address'    => 'sometimes',
            'cep'        => 'sometimes',
            'manager_id' => 'sometimes|exists:' . (new User())->getTable() . ',id',
            'phone'      => 'required|min:8|max:15|unique:' . (new Account())->getTable() . ',phone',
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
            'cnpj'       => ['sometimes', 'min:14', 'max:18' , 'unique:' . $account_table . ', cnpj,' . $id, new CnpjRule],
            'address'    => 'sometimes',
            'cep'        => 'sometimes',
            'manager_id' => 'sometimes|exists:' . (new User())->getTable() . ',id',
            'phone'      => 'sometimes|min:8|max:15|unique:' . (new Account())->getTable() . ',phone,' . $id,
        ];
    }

    /**
     * @param array $data
     */
    public static function validateToCreateGuest(array $data)
    {
        Validator::make($data, [
            'user_name'     => 'required|string|max:255|min:3',
            'user_email'    => 'required|email|max:255|min:3|unique:' . (new User())->getTable() . ',email',
            'account_name'  => 'required|string|max:255|min:3',
            'user_password' => 'required|min:6|max:500',
            'account_phone' => 'required|min:8|max:15|unique:' . (new Account())->getTable() . ',phone',
            'account_cnpj'  => ['bail', 'required', 'min:14', 'max:18', new CnpjRule],
        ])->validate();
    }
}
