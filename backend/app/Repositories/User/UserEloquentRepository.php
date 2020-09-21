<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Eloquent\EloquentRepository;
use App\Scopes\Repository\ScopedRepositoryInterface;
use App\Scopes\Repository\ScopeTrait;

/**
 * Class UserEloquentRepository
 * @package App\Repositories\User
 */
class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface, ScopedRepositoryInterface
{
    use ScopeTrait;

    /** @var User $model */
    public $model;

    /**
     * UserEloquentRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
