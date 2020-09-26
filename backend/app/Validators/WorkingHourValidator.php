<?php

namespace App\Validators;

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
        return [];
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
