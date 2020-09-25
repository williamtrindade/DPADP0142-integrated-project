<?php

namespace App\Repositories\Account;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface AccountRepositoryInterface
 * @package App\Repositories\Account
 */
interface AccountRepositoryInterface
{
    /**
     * AccountRepositoryInterface constructor.
     * @param Account $model
     */
    public function __construct(Account $model);

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
     * @param Model|null $model
     * @return User
     */
    public function update(array $data, int $id = null, Model $model = null): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @return Builder
     */
    public function queryBuilder(): Builder;
}
