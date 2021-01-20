<?php

namespace App\Repositories\Account;

use App\Models\Account;
use App\Repositories\Base\Eloquent\EloquentRepository;

/**
 * Class AccountEloquentRepository
 * @package App\Repositories\Account
 */
class AccountEloquentRepository extends EloquentRepository implements AccountRepositoryInterface
{
    /** @var Account $model */
    public $model;

    /**
     * UserEloquentRepository constructor.
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        $this->model = $model;
    }
}
