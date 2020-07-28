<?php

namespace App\Repositories\Eloquent\Base;

use Illuminate\Database\Eloquent\{Builder, Model};

/**
 * Class Repository
 * @package App\Repositories\Base
 *
 * @property Model $model
 */
abstract class Repository
{
    use BuilderMethodsTrait;
    use CollectionMethodsTrait;
    use ModelMethodsTrait;

    /** @var Builder $builder */
    private $builder;

    public function __construct()
    {
        $this->model = app($this->model);
        $this->builder = $this->model->newQuery();
    }
}
