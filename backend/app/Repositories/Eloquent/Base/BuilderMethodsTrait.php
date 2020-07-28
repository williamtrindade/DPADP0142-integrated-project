<?php

namespace App\Repositories\Eloquent\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait BuilderMethodsTrait
 * @package App\Repositories\Eloquent\Base
 *
 * @property Model $model
 * @property Builder $builder
 */
trait BuilderMethodsTrait
{
    /**
     * @return Builder
     */
    public function getNewBuilder(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * @param int $page
     * @param int $show
     * @return BuilderMethodsTrait
     */
    public function paginate(int $page = 1, int $show = 15)
    {
        $this->builder->forPage($page, $show);
        $this->builder->paginate($show, ['*'], 'page', $page);
        return $this;
    }

    /**
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        if (empty($this->builder)) {
            $this->builder = $this->model->newQuery();
        }
        return $this->builder;
    }
}
