<?php

namespace App\Scopes;

use App\Repositories\RepositoryInterface;

/**
 * Interface ScopableService
 * @package App\Scopes
 * @property RepositoryInterface $repository
 */
interface ScopableService
{
    public function addScope(ScopeInterface $scope);
}
