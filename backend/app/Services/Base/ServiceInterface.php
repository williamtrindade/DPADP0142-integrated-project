<?php


namespace App\Services\Base;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface ServiceInterface
 * @package App\Services\Contracts
 */
interface ServiceInterface
{
    /**
     * @return Collection|Model[]|LengthAwarePaginator
     */
    public function all();

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model;

    /**
     * @param int $id
     * @return Model|null
     */
    public function read(int $id): ?Model;

    /**
     * @param $data
     * @param $id
     * @return bool
     */
    public function update($data, $id): bool;

    /**
     * @param $id
     * @return bool|null
     * @throws Exception
     */
    public function delete(int $id): ?bool;

    /**
     * @param int $page
     * @param int $show
     * @return mixed
     */
    function paginate($page = 1, $show = 15): LengthAwarePaginator;
}
