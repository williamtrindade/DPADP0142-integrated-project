<?php

namespace App\Repositories\PointRecord;

use App\Models\PointRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface PointRecordRepositoryInterface
{
    public function __construct(PointRecord $model);

    public function all(bool $paginate = true, int $page = 1, int $show = 15);

    public function create(array $data): Model;

    public function read(int $id): Model;

    public function update(array $data, int $id = null, Model $model = null): Model;

    public function delete(int $id): bool;

    public function sync(array $ids, string $relation, bool $detach = true): Model;

    public function queryBuilder(): Builder;

    public function resetBuilder(): Builder;

    public function allUnapproved(bool $paginate, int $page, int $show);
}
