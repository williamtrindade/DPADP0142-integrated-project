<?php

namespace App\Services\Base;

use App\Repositories\RepositoryInterface;
use App\Validators\ValidatorInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * @package App\Services
 * @property RepositoryInterface $repository
 * @property ValidatorInterface $validator
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
     * @return Model
     */
    public function create(array $data)
    {
        $this->validator->validateToCreate($data);
        return $this->repository->create($data);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function read(int $id)
    {
        return $this->repository->read($id);
    }

    /**
     * @param $data
     * @param $id
     * @return Model
     */
    public function update($data, $id)
    {
        $this->validator->validateToUpdate($data);
        return $this->repository->update($data, $id);
    }

    /**
     * @param $id
     * @return bool|null
     * @throws Exception
     */
    public function delete(int $id)
    {
        $model = $this->read($id);
        return $model->delete();
    }
}
