<?php

namespace App\Repositories\User;

use App\Models\Base\UserModel;
use App\Repositories\Eloquent\EloquentRepository;

/**
 * Class UserEloquentRepository
 * @package App\Repositories\User
 */
class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /** @var UserModel $model */
    protected $model;

    /**
     * UserEloquentRepository constructor.
     * @param UserModel $model
     */
    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }
}