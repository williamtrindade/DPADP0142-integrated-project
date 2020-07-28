<?php

namespace App\Services;

use App\Repositories\Account\AccountRepositoryInterface;
use App\Services\Base\Service;

/**
 * Class AccountService
 * @package App\Services
 */
class AccountService extends Service
{
    /** @var AccountRepositoryInterface $repository */
    public $repository;

    /**
     * AccountService constructor.
     * @param AccountRepositoryInterface $repository
     */
    public function __construct(AccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}