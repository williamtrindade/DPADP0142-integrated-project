<?php

namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Repositories\Eloquent\Base
 */
interface RepositoryInterface
{
    public function all();
    public function get();
    public function create(array $data);
    public function read(int $id);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function getBuilder();
    public function paginate(int $page, int $show);
}
