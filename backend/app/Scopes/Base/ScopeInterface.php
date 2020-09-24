<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface ScopeInterface
 * @package App\Scopes
 *
 * @property $param mixed
 */
interface ScopeInterface
{
    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder;
}
