<?php

namespace App\Filters\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

/**
 * Class FilterProcessor
 * @package App\Filters\Base
 */
class FilterProcessor
{
    /** @var FilterInterface $filter */
    private $filter;

    /** @var Builder $builder */
    private $builder;

    /** @var array $query */
    private $query;

    /**
     * FilterProcessor constructor.
     * @param FilterInterface $filter
     * @param Builder   $builder
     * @param array           $query
     */
    public function __construct(FilterInterface $filter, Builder &$builder, array $query)
    {
        $this->filter  = $filter;
        $this->builder = &$builder;
        $this->query   = $query;
    }

    /**
     * @return void
     */
    public function filter()
    {
        if (!empty($this->query)) {
            collect($this->filter->getFilters())->each(function($filter_value, $filter_key) {
                if (!is_numeric($filter_key)) {
                    $this->createFilter($filter_key, $filter_value);
                }
            });
        }
    }

    /**
     * @param $filter_key
     * @param $filter_value
     * @return void
     */
    private function createFilter($filter_key, $filter_value)
    {
        if (($query_value = Arr::get($this->query, $filter_key)) != null) {
            switch ($filter_value) {
                case 'like': {
                    $this->builder = $this->builder->where($filter_key, 'like', "%$query_value%");
                }
            }
        }
    }
}
