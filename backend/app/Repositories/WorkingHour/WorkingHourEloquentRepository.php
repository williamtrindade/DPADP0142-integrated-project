<?php

namespace App\Repositories\WorkingHour;

use App\Models\WorkingHour;
use App\Repositories\Base\Eloquent\EloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return $this->queryBuilder()->with('timeBlocks')->get();
    }

    /**
     * @param int $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function read(int $id): Model
    {
        return $this->queryBuilder()->where('id', '=', $id)->with('timeBlocks')->firstOrFail();
    }

    /**
     * @param int $id
     * @return void
     */
    public function unsetTimeBlocks(int $id)
    {
        $this->read($id)->timeBlocks()->delete();
    }
}
