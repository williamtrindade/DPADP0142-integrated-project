<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\Base\Service;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends Service
{
    /** @var UserRepositoryInterface $repository */
    public $repository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
