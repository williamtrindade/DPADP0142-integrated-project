<?php

use Illuminate\Support\Facades\Validator;

/**
 * @param string $email
 * @return bool
 */
function validMail(string $email): bool
{
    return !Validator::make(['email' => $email], [
        'email' => 'required|email'
    ])->fails();
}
