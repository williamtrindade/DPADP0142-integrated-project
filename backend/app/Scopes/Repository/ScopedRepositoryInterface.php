<?php

namespace App\Scopes\Repository;

use App\Scopes\ScopeInterface;

/**
 * Class ScopedRepositoryInterface
 * @package App\Repositories\Traits\Contracts
 */
interface ScopedRepositoryInterface
{
    /**
     * @param ScopeInterface $scope
     */
    public function addScope(ScopeInterface $scope): void;
}
