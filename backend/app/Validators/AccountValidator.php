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
     * @return array
     */
    public static function validateToCreate(): array
    {
        return [
            'name' => 'required',
            'cnpj' => 'required',
            'address' => 'sometimes',
            'cep' => 'sometimes',
            'manager_id' => 'required|exists:' . (new User())->getTable() . ',id',
            'phone' => 'required|min:8|max:15|unique:' . (new Account())->getTable() . ',phone',
        ];
    }

    /**
     * @param int|null $account_id
     * @return array
     */
    public static function validateToUpdate(int $account_id = null): array
    {
        return [];
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
            'account_phone' => 'required|min:8|max:15|unique:' . (new Account())->getTable() . ',phone',
            'account_cnpj' => ['bail', 'required', 'min:14', 'max:18', new CnpjRule],
        ])->validate();
    }
}
