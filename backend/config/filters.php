<?php

use App\Filters\UserFilter;
use App\Services\UserService;

return [
    UserService::class => UserFilter::class,
];
