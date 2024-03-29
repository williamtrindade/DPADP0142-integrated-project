<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|void
     */
    protected function redirectTo($request)
    {
        $request->headers->set('accept', 'application/json', true);
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
