<?php

namespace App\Scopes\Repository;

use App\Scopes\ScopeInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait RepositoryScopeTrait
 *
 * @package App\Repositories\Traits
 * @property Model $model
 */
trait RepositoryScopeTrait
{
    public function addScope(ScopeInterface $scope): void
    {
        $this->model = $scope->apply($this->model->query());
    }
}
