<?php

namespace App\Repositories\Eloquent\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Trait CollectionMethodsTrait
 * @package App\Repositories\Eloquent\Base
 *
 * @property Builder $builder
 */
trait CollectionMethodsTrait
{
    /**
     * @return Collection
     */
    public final function get(): Collection
    {
        return $this->builder->get();
    }
}
