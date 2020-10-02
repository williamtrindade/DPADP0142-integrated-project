<?php

namespace App\Validators;

use App\Models\Account;
use App\Models\TimeBlock;
use App\Models\User;
use App\Validators\Base\ValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
        return [
            'account_id'  => 'sometimes|integer|exists:' . (new Account())->getTable() . ',id',
            'user_id'     => 'sometimes|integer|exists:' . (new User())->getTable() . ',id',
            'name'        => 'sometimes|string|min:3|max:255',
            'description' => 'sometimes|min:3|max:255',
        ];
    }

    /**
     * @return array
     */
    public function rulesToValidateCreationFields(): array
    {
        return [
            'working_hour'     => 'required',
            'time_blocks'      => 'required|array',
            'time_blocks.*.id' => 'sometimes|integer|exists:' . (new TimeBlock())->getTable() . ',id',
        ];
    }

    /**
     * @param array $data
     * @throws ValidationException
     */
    public function validateCreationFields(array $data)
    {
        Validator::make($data, $this->rulesToValidateCreationFields())->validate();
    }
}
