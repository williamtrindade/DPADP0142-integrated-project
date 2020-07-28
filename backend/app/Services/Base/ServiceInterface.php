<?php

namespace App\Services\Base;

use App\Models\Contracts\ModelInterface;
use Exception;

/**
 * Interface ServiceInterface
 * @package App\Services\Contracts
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
     * @return ModelInterface
     */
    public function read(int $id): ModelInterface;

    /**
     * @param $data
     * @param $id
     * @return ModelInterface
     */
    public function update($data, $id): ModelInterface;

    /**
     * @param $id
     * @return bool|null
     * @throws Exception
     */
    public function delete(int $id): ?bool;
}
