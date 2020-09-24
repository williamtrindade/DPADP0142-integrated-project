<?php

namespace App\Scopes\Service;

use App\Scopes\ScopeInterface;
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
        $this->repository->model = $scope->apply($this->repository->model->query());
        return $this;
    }
}
