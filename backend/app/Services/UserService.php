<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use App\Services\Base\Service;
use App\Validators\UserValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends Service
{
    /** @var UserRepositoryInterface $repository */
    public $repository;

    /** @var UserValidator $validator */
    public $validator;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepositoryInterface $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $this->validateToCreate($data);
        Arr::set($data, 'password', Hash::make($data['password']));
        return $this->repository->create($data);
    }

    /**
     * @param $data
     * @param $id
     * @return Model
     */
    public function update($data, $id)
    {
        $this->validateToUpdate($data, $id);
        if ($pass = Arr::get($data, 'password', false)) $data['password'] = Hash::make($pass);
        return parent::update($data, $id);
    }
}
