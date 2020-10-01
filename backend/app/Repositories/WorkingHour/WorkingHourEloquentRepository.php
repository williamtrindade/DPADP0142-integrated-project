<?php

namespace App\Repositories\WorkingHour;

use App\Models\WorkingHour;
use App\Repositories\Eloquent\EloquentRepository;

/**
 * Class WorkingHourEloquentRepository
 */
class WorkingHourEloquentRepository extends EloquentRepository implements WorkingHourRepositoryInterface
{
    /** @var WorkingHour $model */
    public $model;

    /**
     * UserEloquentRepository constructor.
     * @param WorkingHour $model
     */
    public function __construct(WorkingHour $model)
    {
        $this->model = $model;
    }

    /**
     * @param bool $paginate
     * @param int $page
     * @param int $show
     * @return mixed
     */
    public function all(bool $paginate = true, int $page = 1, int $show = 15)
    {
        if ($paginate) {
            $this->queryBuilder = $this->queryBuilder()->with(array('timeBlocks'));
            return $this->paginate($page, $show);
        }
        return $this->model->with('timeBlocks')->get();
    }
}
