<?php

namespace App\Services\Base;

use App\Repositories\RepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class Service
 * @package App\Services
 * @property RepositoryInterface $repository
 */
abstract class Service implements ServiceInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model
    {
        return $this->repository->create($data);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function read(int $id): ?Model
    {
        return $this->repository->find($id);
    }

    /**
     * @param $data
     * @param $id
     * @return bool
     */
    public function update($data, $id): bool
    {
        return $this->repository->update($data, $id);
    }

    /**
     * @param $id
     * @return bool|null
     * @throws Exception
     */
    public function delete(int $id): ?bool
    {
        /** @var Model $model */
        $model = $this->read($id);
        return $model->delete();
    }

    /**
     * @param int $page
     * @param int $show
     * @return LengthAwarePaginator
     */
    public function paginate($page = 1, $show = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($page, $show);
    }
}
