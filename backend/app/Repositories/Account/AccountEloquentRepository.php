<?php

namespace App\Repositories\Account;

use App\Models\Base\AccountModel;
use App\Repositories\Eloquent\EloquentRepository;

/**
 * Class AccountEloquentRepository
 * @package App\Repositories\Account
 */
class AccountEloquentRepository extends EloquentRepository implements AccountRepositoryInterface
{
    /** @var AccountModel $model */
    private $model;

    /**
     * UserEloquentRepository constructor.
     * @param AccountModel $model
     */
    public function __construct(AccountModel $model)
    {
        $this->model = $model;
    }
}