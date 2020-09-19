<?php

use Illuminate\Support\Facades\Validator;

/**
 * @param $email
 * @return bool
 */
function validMail($email): bool
{
    return !Validator::make(['email' => $email], [
        'email' => 'email|required'
    ])->fails();
}
