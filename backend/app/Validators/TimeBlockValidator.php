<?php

namespace App\Validators;

use App\Models\Account;
use App\Models\TimeBlock;
use App\Models\WorkingHour;
use App\Validators\Base\ValidatorInterface;

/**
 * Class TimeBlockValidator
 * @package App\Validators
 */
class TimeBlockValidator implements ValidatorInterface
{
    /**
     * @param array $data
     * @return string[]
     */
    public static function validateToCreate(array $data): array
    {
        return [
            'account_id'         => 'required|integer|exists:' . (new Account())->getTable() . ',id',
            'working_hour_id'    => 'required|integer|exists:' . (new WorkingHour())->getTable() . ',id',
            'start_hour'         => 'required|date_format:H:i',
            'end_hour'           => 'required|date_format:H:i',
            '.*.weekDays'        => 'required|array',
            '.*.weekDays.*.id'   => 'required|integer|in:' . TimeBlock::getWeekDaysValues()->implode(','),
            'weekDays.*.value'   => 'required|boolean',
        ];
    }

    public static function validateToUpdate(array $data, int $id): array
    {
        return [];
    }
}
