<?php

namespace App\Validators;

/**
 * Interface ValidatorInterface
 * @package App\Validators
 */
interface ValidatorInterface
{
    public static function validateToCreate(): array;
    public static function validateToUpdate(int $account_id = null): array;
}
