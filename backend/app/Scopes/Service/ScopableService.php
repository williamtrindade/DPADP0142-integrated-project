<?php

namespace App\Scopes;

use App\Repositories\EloquentRepositoryInterface;

/**
 * Interface ScopableService
 * @package App\Scopes
 * @property EloquentRepositoryInterface $repository
 */
interface ScopableService
{
    public function addScope(ScopeInterface $scope);
}
