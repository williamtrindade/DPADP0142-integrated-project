<?php

namespace App\Services\Base;

use App\Validators\Base\ValidatorInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class Service
 * @package App\Services
 * @property mixed $repository
 * @property ValidatorInterface $validator
 */
abstract class Service
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
     * @throws ValidationException
     */
    public function create(array $data)
    {
        $this->validateToCreate($data);
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
     * @throws ValidationException
     */
    public function update($data, $id)
    {
        $item = $this->repository->read($id);
        $this->validateToUpdate($data, $id);
        return $this->repository->update($data, null, $item);
    }

    /**
     * @param $id
     * @return bool|null
     * @throws Exception
     */
    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @param $data
     * @throws ValidationException
     */
    public function validateToCreate($data)
    {
        Validator::make($data, $this->validator::validateToCreate($data))->validate();
    }

    /**
     * @param $data
     * @param int $id
     * @throws ValidationException
     */
    public function validateToUpdate($data, int $id)
    {
        Validator::make($data, $this->validator::validateToUpdate($data, $id))->validate();
    }
}
