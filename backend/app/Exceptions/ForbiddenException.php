<?php

namespace App\Exceptions;

class ForbiddenException extends \Exception
{
    /**
     * Class constructor
     *
     * @param string $message Error message
     * @param int    $code    Error code
     */
    public function __construct($message = 'Forbidden', $code = 403)
    {
        parent::__construct($message, $code);
    }
}
