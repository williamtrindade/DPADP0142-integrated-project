<?php

namespace App\Filters\Service;

use App\Filters\Base\FilterInterface;
use App\Filters\Base\FilterProcessor;

/**
 * Trait ServiceFilterTrait
 * @package App\Filters\Service
 */
trait ServiceFilterTrait
{
    /**
     * @param array $query
     * @return mixed
     */
    public function filter(array $query)
    {
        /** @var FilterInterface $filter */
        $filter = app(config('filters.' . self::class));
        new FilterProcessor($filter, $this->repository->model, $query);
        return $this;
    }
}
