<?php

namespace App\Services\Base;

use App\Models\Contracts\ModelInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * @package App\Services
 * @property $repository
 */
abstract class Service implements ServiceInterface
{
    /**
     * @param bool $paginate
     * @param int $page
     * @param int $show
     * @return mixed
     */
    public function all(bool $paginate = true, int $page = 1, int $show = 15)
    {
        return $this->repository->all($paginate, $page, $show);
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * @param int $id
     * @return ModelInterface
     */
    public function read(int $id): ModelInterface
    {
        return $this->repository->read($id);
    }

    /**
     * @param $data
     * @param $id
     * @return ModelInterface
     */
    public function update($data, $id): ModelInterface
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
}
