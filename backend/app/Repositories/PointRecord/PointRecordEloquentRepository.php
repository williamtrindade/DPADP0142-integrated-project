<?php


namespace App\Repositories\PointRecord;


use App\Models\PointRecord;
use App\Scopes\Repository\ScopeTrait;

class PointRecordEloquentRepository
{
    use ScopeTrait;

    /** @var PointRecord $model */
    public $model;

    /**
     * UserEloquentRepository constructor.
     * @param PointRecord $model
     */
    public function __construct(PointRecord $model)
    {
        $this->model = $model;
    }
}
