<?php

namespace App\Validators;

use App\Models\Account;
use App\Models\PointRecord;
use App\Models\User;
use App\Validators\Base\ValidatorInterface;

class PointRecordValidator implements ValidatorInterface
{
    public static function validateToCreate(array $data): array
    {
        return [
            'lat'        => 'required',
            'lng'        => 'required   ',
            'status'     => 'required|integer|in:' . PointRecord::getStatuses()->implode(','),
            'type'       => 'required|integer|in:' . PointRecord::getTypes()->implode(','),
            'account_id' => 'required|integer|exists:' . (new Account())->getTable() . ',id',
            'user_id'    => 'required|integer|exists:' . (new User())->getTable() . ',id',
        ];
    }

    public static function validateToUpdate(array $data, int $id): array
    {
        return [];
    }
}
