<?php

namespace App\Repositories\PointRecord;

use App\Models\PointRecord;
use App\Repositories\Base\Eloquent\EloquentRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class PointRecordEloquentRepository extends EloquentRepository implements PointRecordRepositoryInterface
{
    /** @var PointRecord $model */
    public $model;

    public function __construct(PointRecord $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Model
    {
        try {
            return $this->model->create($data);
        } catch (Throwable $e) {
            throw new Exception('Error on create a Eloquent model in table ['.(new $this->model)->getTable().']');
        }
    }

    public function all(bool $paginate = false, int $page = 1, int $show = 15)
    {
        $this->queryBuilder->orderBy('id', 'desc');
        if ($paginate) {
            return $this->paginate($page, $show);
        }
        return $this->queryBuilder()->get();
    }

    public function allUnapproved(bool $paginate, int $page, int $show)
    {
        $this->queryBuilder->orderBy('id', 'desc');
        $this->queryBuilder->where('status', '=', PointRecord::ON_HOLD_STATUS);
        $this->queryBuilder->with('user');
        if ($paginate) {
            return $this->paginate($page, $show);
        }
        return $this->queryBuilder()->get();
    }
}
