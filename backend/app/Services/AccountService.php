<?php

namespace App\Services;

use App\Repositories\Account\AccountRepositoryInterface;
use App\Services\Base\Service;
use App\Validators\AccountValidator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AccountService
 * @package App\Services
 */
class AccountService extends Service
{
    /** @var AccountRepositoryInterface $repository */
    public $repository;

    /** @var AccountValidator $validator */
    public $validator;

    /**
     * AccountService constructor.
     * @param AccountRepositoryInterface $repository
     * @param AccountValidator $validator
     */
    public function __construct(AccountRepositoryInterface $repository, AccountValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $this->validator::validateToCreateGuest($data);
        $this->validator::validateToCreate($data);
        return $this->repository->create($data);
    }
}
