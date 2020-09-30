<?php

namespace App\Validators;

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
            'workingHour' => 'required',
            'workingHour.name' => 'required|string|min:3|max:255',
            'workingHour.description' => 'required|string|min:3|max:255',
//            'timeBlocks' => 'array|required',
//            'timeBlocks.*.entranceTime' => 'required|time',
//            'timeBlocks.*.exitTime' => 'required|time',
//            'timeBlocks.*.weekDays' => 'required|array',
//            'timeBlocks.*.weekDays.*.id' => 'required|int',
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
