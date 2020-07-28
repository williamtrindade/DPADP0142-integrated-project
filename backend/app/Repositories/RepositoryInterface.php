<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


/**
 * Interface RepositoryInterface
 * @package App\Repositories
 *
 * @method Builder getNewBuilder()
 * @method paginate(int $page = 1, int $show = 15)
 * @method Builder getBuilder()
 * @method Collection get()
 * @method Model create(array $data)
 * @method Model read(int $id) throws ModelNotFoundException
 * @method bool update(array $data, int $id)
 * @method bool delete(int $id)
 */
interface RepositoryInterface
{
}
