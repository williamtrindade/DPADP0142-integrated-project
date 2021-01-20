<?php

namespace App\Scopes\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface ScopeInterface
 * @package App\Scopes
 *
 * @property $param mixed
 */
interface ScopeInterface
{
    /**
     * @param Model|Builder $builder
     * @return Builder
     */
    public function apply($builder): Builder;
}
