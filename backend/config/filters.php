<?php

use App\Filters\UserFilter;
use App\Services\UserService;

return [
    'builder_location' => 'repository.queryBuilder()',
    'entities' => [
        UserService::class => UserFilter::class,
    ],
];
