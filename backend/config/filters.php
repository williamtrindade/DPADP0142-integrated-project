<?php

use App\Filters\PointRecordFilter;
use App\Filters\UserFilter;
use App\Filters\WorkingHourFilter;
use App\Services\PointRecordService;
use App\Services\UserService;
use App\Services\WorkingHourService;

return [
    'builder_location' => 'repository.queryBuilder()',
    'entities' => [
        UserService::class => UserFilter::class,
        WorkingHourService::class => WorkingHourFilter::class,
        PointRecordService::class => PointRecordFilter::class,
    ],
];
