<?php

namespace App\Repositories\EmployeeInvitation;

use App\Models\Account;
use App\Models\EmployeeInvitation;

class EmployeeInvitationEloquentRepository implements EmployeeInvitationRepositoryInterface
{
    /** @var EmployeeInvitation $model */
    public $model;

    /**
     * EmployeeInvitationEloquentRepository constructor.
     * @param EmployeeInvitation $model
     */
    public function __construct(EmployeeInvitation $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $hash
     * @return bool
     */
    public function validateHash(string $hash): bool
    {
        return $this->model->newQuery()
            ->where('hash', '=', $hash)
            ->get()->isNotEmpty();
    }

    /**
     * @param string $hash
     * @return Account
     */
    public function getAccountByHash(string $hash): Account
    {
        /** @var EmployeeInvitation $invite */
        $invite = $this->model->newQuery()
            ->where('hash', '=', $hash)
            ->firstOrFail();
        return $invite->account();
    }
}
