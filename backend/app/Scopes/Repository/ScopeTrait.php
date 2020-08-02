<?php

namespace App\Scopes\Repository;

use App\Scopes\ScopeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait ScopeTrait
 * @package App\Repositories\Traits
 * @property Model $model
 */
trait ScopeTrait
{
    public function addScope(ScopeInterface $scope): void
    {
        $this->model = $scope->apply($this->model->query());
    }
}
