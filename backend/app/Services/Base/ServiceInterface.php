<?php

namespace App\Services\Base;

use App\Repositories\RepositoryInterface;
use App\Validators\ValidatorInterface;

/**
 * Interface ServiceInterface
 * @package App\Services\Contracts
 * @property RepositoryInterface $repository
 * @property ValidatorInterface $validator
 */
interface ServiceInterface
{
    /**
     * @param bool $paginate
     * @param int $page
     * @param int $show
     * @return mixed
     */
    public function all(bool $paginate = true, int $page = 1, int $show = 15);

    /**
     * @param array $data
     */
    public function create(array $data);

    /**
     * @param int $id
     */
    public function read(int $id);

    /**
     * @param $data
     * @param $id
     */
    public function update($data, $id);

    /**
     * @param $id
     */
    public function delete(int $id);

    /**
     * @param array $data
     * @return mixed
     */
    public function validateToCreate(array $data);

    /**
     * @param $data
     * @param int|null $account_id
     * @return mixed
     */
    public function validateToUpdate($data, int $account_id = null);
}
