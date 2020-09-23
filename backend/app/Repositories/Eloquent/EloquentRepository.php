<?php

namespace App\Repositories\Eloquent;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\{Model, ModelNotFoundException};
use Exception;
use Throwable;

/**
 * Class EloquentRepository
 * @package App\Repositories\Base
 *
 * @property Model $model
 */
abstract class EloquentRepository implements RepositoryInterface
{
    protected $model;

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
        try {
            return $this->model->create($data);
        } catch (Throwable $e) {
            throw new Exception('Error on create a Eloquent model in table ['.(new $this->model)->getTable().']');
        }
    }

    /**
     * @param int $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function read($id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Updates by Id or by Model Object
     *
     * @param array $data
     * @param int|null $id
     * @param Model|null $item
     * @return Model
     * @throws Exception
     */
    public function update(array $data, int $id = null, Model $item = null): Model
    {
        if (($id == null) && ($item != null)) {
            $item->update($data);
        } elseif (($id != null) && ($item == null)) {
            $item = $this->read($id);
            $item->update($data);
            return $item;
        } elseif (($id == null) && ($item == null)) {
            throw new Exception('Error on update a Eloquent model in table ['.(new $this->model)->getTable().']');
        }
        return $item;
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
