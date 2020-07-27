<?php

namespace App\Repositories\Eloquent\Base;

use App\Repositories\RepositoryInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

/**
 * Class Repository
 * @package App\Repositories\Base
 */
abstract class Repository implements RepositoryInterface
{
    /** @var Model $model */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return Builder[]|Collection
     */
    public function get()
    {
        return $this->getBuilder()->get();
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

    /**
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * @param int $page
     * @param int $show
     * @return LengthAwarePaginator
     */
    public function paginate(int $page, int $show): LengthAwarePaginator
    {
        $this->getBuilder()->forPage($page, $show);
        return $this->getBuilder()->paginate($show, ['*'], 'page', $page);
    }
}
