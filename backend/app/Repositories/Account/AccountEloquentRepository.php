<?php

namespace App\Repositories\Account;

use App\Models\Account;
use App\Repositories\Eloquent\EloquentRepository;
use App\Scopes\Repository\ScopedRepositoryInterface;
use App\Scopes\Repository\ScopeTrait;

/**
 * Class AccountEloquentRepository
 * @package App\Repositories\Account
 */
class AccountEloquentRepository extends EloquentRepository implements AccountRepositoryInterface, ScopedRepositoryInterface
{
    use ScopeTrait;

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
