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
}
