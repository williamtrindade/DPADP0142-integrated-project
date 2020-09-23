<?php

namespace App\Scopes\Service;

use App\Scopes\Repository\ScopedRepositoryInterface;
use App\Scopes\ScopeInterface;

/**
 * Class ServiceScopeTrait
 *
 * @package App\Scopes\Service
 * @property ScopedRepositoryInterface $repository
 */
trait ServiceScopeTrait
{
    public function addScope(ScopeInterface $scope): void
    {
        $this->repository->addScope($scope);
    }
}
