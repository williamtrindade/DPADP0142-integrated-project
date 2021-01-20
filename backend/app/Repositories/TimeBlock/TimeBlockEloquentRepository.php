<?php

namespace App\Repositories\TimeBlock;

use App\Models\TimeBlock;
use App\Repositories\Base\Eloquent\EloquentRepository;

/**
 * Class TimeBlockEloquentRepository
 * @package App\Repositories\TimeBlock
 */
class TimeBlockEloquentRepository extends EloquentRepository implements TimeBlockRepositoryInterface
{
    /** @var TimeBlock $model */
    public $model;

    /**
     * TimeBlockEloquentRepository constructor.
     * @param TimeBlock $model
     */
    public function __construct(TimeBlock $model)
    {
        $this->model = $model;
    }
}
