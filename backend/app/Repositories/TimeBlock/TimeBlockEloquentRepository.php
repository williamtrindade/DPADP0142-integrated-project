<?php

namespace App\Repositories\TimeBlock;

use App\Models\TimeBlock;
use App\Repositories\Eloquent\EloquentRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Throwable;

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

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function create(array $data): Model
    {
        try {
            return $this->model->create($data);
        } catch (Throwable $e) {
            throw new Exception('Error on create a Eloquent model in table ['.(new $this->model)->getTable().']');
        }
    }
}
