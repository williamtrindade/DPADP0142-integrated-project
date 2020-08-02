<?php

namespace App\Scopes\Service;

use App\Scopes\Repository\ScopedRepositoryInterface;
use App\Scopes\ScopeInterface;

/**
 * Class ScopeTrait
 * @package App\Scopes\Service
 * @property ScopedRepositoryInterface $repository
 */
trait ScopeTrait
{
    public function addScope(ScopeInterface $scope): void
    {
        $this->repository->addScope($scope);
    }
}
