<?php

namespace App\Filters\Service;

use App\Repositories\EloquentRepositoryInterface;

/**
 * Interface FilterableServiceInterface
 * @package App\Filters\Service
 * @property EloquentRepositoryInterface $repository
 */
interface FilterableServiceInterface
{
    public function filter(array $query);
}
