<?php

namespace App\Scopes\Service;

use App\Scopes\Base\ScopeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceScopeTrait
 *
 * @package App\Scopes\Service
 * @property Model $model
 */
trait ServiceScopeTrait
{
    /**
     * @param ScopeInterface $scope
     * @return mixed
     */
    public function addScope(ScopeInterface $scope)
    {
        $this->repository->queryBuilder = $scope->apply($this->repository->queryBuilder());
        return $this;
    }
}
