<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Base\Repository;
use App\Repositories\RepositoryInterface;
use App\User;

/**
 * Class UserRepository
 * @package App\Repositories\Eloquent
 */
class UserRepository extends Repository implements RepositoryInterface
{
    public $model = User::class;
}
