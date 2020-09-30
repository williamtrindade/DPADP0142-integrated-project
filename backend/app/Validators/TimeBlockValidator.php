<?php

namespace App\Validators;

use App\Validators\Base\ValidatorInterface;

/**
 * Class TimeBlockValidator
 * @package App\Validators
 */
class TimeBlockValidator implements ValidatorInterface
{
    public static function validateToCreate(array $data): array
    {
        return [];
    }

    public static function validateToUpdate(array $data, int $id): array
    {
        return [];
    }
}
