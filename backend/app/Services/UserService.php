<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\Base\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ])->validate();
        Arr::set($data, 'password', Hash::make($data['password']));
        return $this->repository->create($data);
    }
}
