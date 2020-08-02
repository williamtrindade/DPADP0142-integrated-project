<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */
interface RepositoryInterface
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
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param int $id
     * @return Model
     */
    public function read(int $id): Model;

    /**
     * @param array $data
     * @param int|null $id
     * @param Model|null $item
     * @return Model
     */
    public function update(array $data, int $id = null, Model $item = null): Model;

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool;
}
