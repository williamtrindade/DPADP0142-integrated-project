<?php

namespace App\Validators;

/**
 * Interface ValidatorInterface
 * @package App\Validators
 */
interface ValidatorInterface
{
    public static function validateToCreate(array $data);
    public static function validateToUpdate(array $data, int $account_id = null);
}
