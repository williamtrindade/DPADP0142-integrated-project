<?php

namespace App\Filters\Service;

use App\Repositories\RepositoryInterface;

/**
 * Interface FilterableServiceInterface
 * @package App\Filters\Service
 * @property RepositoryInterface $repository
 */
interface FilterableServiceInterface
{
    public function filter(array $query);
}
