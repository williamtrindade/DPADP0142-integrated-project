<?php

namespace App\Repositories\TimeBlock;

use App\Models\TimeBlock;
use Illuminate\Database\Eloquent\Builder;

/**
 * Interface TimeBlockRepositoryInterface
 * @package App\Repositories\TimeBlock
 */
interface TimeBlockRepositoryInterface
{
    /**
     * UserRepositoryInterface constructor.
     * @param TimeBlock $model
     */
    public function __construct(TimeBlock $model);

    /**
     * @param bool $paginate
     * @param int $page
     * @param int $show
     * @return mixed
     */
    public function all(bool $paginate = true, int $page = 1, int $show = 15);

    /**
     * @param array $data
     * @return TimeBlock
     */
    public function create(array $data): TimeBlock;

    /**
     * @param int $id
     * @return TimeBlock
     */
    public function read(int $id): TimeBlock;

    /**
     * @param array $data
     * @param int|null $id
     * @param TimeBlock|null $item
     * @return TimeBlock
     */
    public function update(array $data, int $id = null, TimeBlock $item = null): TimeBlock;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @return Builder
     */
    public function queryBuilder(): Builder;

    /**
     * @return Builder
     */
    public function resetBuilder(): Builder;
}
