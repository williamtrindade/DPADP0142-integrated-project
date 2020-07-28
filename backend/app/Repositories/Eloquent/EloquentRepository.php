<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\{Model, ModelNotFoundException};
use Exception;
use Throwable;

/**
 * Class EloquentRepository
 * @package App\Repositories\Base
 *
 * @property Model $model
 */
abstract class EloquentRepository
{
    /**
     * @param bool $paginate
     * @param int $page
     * @param int $show
     * @return mixed
     */
    public function all(bool $paginate = true, int $page = 1, int $show = 15)
    {
        if ($paginate) {
            return $this->paginate($page, $show);
        }
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function create(array $data): Model
    {
        /** @var Model $model */
        $model = new $this->model;
        $model->fill($data);
        try {
            $model->saveOrFail();
        } catch (Throwable $e) {
            throw new Exception('Error on save a Eloquent model');
        }
        return $model;
    }

    /**
     * @param int $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function read(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id): Model
    {
        $model = $this->read($id);
        $model->update($data);
        return $model;
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        return $this->read($id)->delete();
    }

    /**
     * @param int $page
     * @param int $show
     * @return mixed
     */
    public function paginate(int $page = 1, $show = 15)
    {
        return $this->model->paginate($show, ['*'], 'page', $page);
    }
}
