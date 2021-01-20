<?php

namespace App\Scopes\Service;

use App\Repositories\Base\Eloquent\EloquentRepositoryInterface;
use App\Scopes\Base\ScopeInterface;

/**
 * Interface ScopableService
 * @package App\Scopes
 * @property EloquentRepositoryInterface $repository
 */
interface ScopableService
{
    public function addScope(ScopeInterface $scope);
}
