<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories\User
 */
interface UserRepositoryInterface
{
    /**
     * UserRepositoryInterface constructor.
     * @param User $model
     */
    public function __construct(User $model);

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
     * @return User
     */
    public function update(array $data, int $id = null, Model $item = null): Model;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param array $ids
     * @param string $relation
     * @param bool $detach
     * @return Model
     */
    public function sync(array $ids, string $relation, bool $detach = true): Model;

    /**
     * @return Builder
     */
    public function queryBuilder(): Builder;

    /**
     * @return Builder
     */
    public function resetBuilder(): Builder;

    /**
     * @param int $userId
     * @param int $workingHourId
     * @throws Throwable
     * @return bool
     */
    public function updateWorkingHour(int $userId, int $workingHourId);
}
