<?php

namespace App\Validators\Base;

/**
 * Interface ValidatorInterface
 * @package App\Validators
 */
interface ValidatorInterface
{
    public static function validateToCreate(array $data): array;
    public static function validateToUpdate(array $data, int $id): array;
}
