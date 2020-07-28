<?php

namespace App\Repositories\Eloquent\Base;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

/**
 * Trait ModelMethodsTrait
 * @package App\Repositories\Eloquent\Base
 *
 * @property Model $model
 */
trait ModelMethodsTrait
{
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
     * @return bool
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): bool
    {
        return $this->read($id)->update($data);
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
}
