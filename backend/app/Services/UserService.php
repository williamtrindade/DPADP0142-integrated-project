<?php

namespace App\Services;

use App\Filters\Service\FilterableServiceInterface;
use App\Filters\Service\ServiceFilterTrait;
use App\Models\User;
use App\Repositories\EmployeeInvitation\EmployeeInvitationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Scopes\ScopableService;
use App\Scopes\Service\ServiceScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\UserValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends Service implements ServiceInterface, ScopableService, FilterableServiceInterface
{
    use ServiceScopeTrait;
    use ServiceFilterTrait;

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
     * @param bool $paginate
     * @param int $page
     * @param int $show
     * @return mixed
     */
    public function all(bool $paginate = true, int $page = 1, int $show = 15)
    {
        return $this->repository->all($paginate, $page, $show);
    }

    /**
     * @param array $data
     * @return Model
     * @throws ValidationException
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
     * @throws ValidationException
     */
    public function update($data, $id)
    {
        $this->validateToUpdate($data, $id);
        if ($pass = Arr::get($data, 'password', false)) {
            $data['password'] = Hash::make($pass);
        }
        return parent::update($data, $id);
    }

    /**
     * @param array $data
     * @return Model
     * @throws ValidationException
     */
    public function createByInvitationHash(array $data)
    {
        $this->validator->validateToCreateByInvitationHash($data);
        $data['account_id'] = app(EmployeeInvitationRepositoryInterface::class)
                                  ->getAccountByHash($data['hash'])->id;
        $data['permission'] = User::EMPLOYEE_PERMISSION;
        return $this->create($data);
    }
}
