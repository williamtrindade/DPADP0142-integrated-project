<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use App\Services\Base\Service;
use App\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends Service
{
    /** @var User $repository */
    public $repository;

    /**
     * UserService constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->repository = $user;
    }
}
