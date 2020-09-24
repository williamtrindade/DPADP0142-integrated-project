<?php

namespace App\Filters\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FilterProcessor
 * @package App\Filters\Base
 */
class FilterProcessor
{
    /** @var FilterInterface $filter */
    private $filter;

    /** @var Model $model */
    private $model;

    /** @var array $query */
    private $query;

    /**
     * FilterProcessor constructor.
     * @param FilterInterface $filter
     * @param Model $model
     * @param array $query
     */
    public function __construct(FilterInterface $filter, Model $model, array $query)
    {
        $this->filter = $filter;
        $this->model  = $model;
        $this->query  = $query;
    }

}
