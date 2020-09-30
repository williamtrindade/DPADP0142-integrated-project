<?php

namespace App\Filters\Service;

use App\Filters\Base\FilterInterface;
use App\Filters\Base\FilterProcessor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Trait FilterTrait
 * @package App\Filters\Service
 */
trait FilterTrait
{
    /**
     * @param array $query
     * @return mixed
     */
    public function filter(array $query)
    {
        /** @var FilterInterface $entity_filter */
        $entity_filter = app(config('filters.entities.' . self::class));
        $builder = $this->getBuilderProperty();
        $filter_processor = new FilterProcessor($entity_filter, $builder, $query);
        $filter_processor->filter();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBuilderProperty(): Builder
    {
        $builder_location_string = config('filters.builder_location');
        $builder_location_collection = collect(explode('.', $builder_location_string));
        $builder = $this;
        $builder_location_collection->each(function($var) use (&$builder) {
            if (Str::contains($var, '()')) {
                $var = str_replace('()', '', $var);
                $builder = $builder->{$var}();
                return;
            }
            $builder = $builder->{$var};
        });
        return $builder;
    }
}
