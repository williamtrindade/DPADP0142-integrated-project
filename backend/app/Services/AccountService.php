<?php

namespace App\Services;

use App\Models\Account;
use App\Models\User;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Scopes\Service\ScopableService;
use App\Scopes\Service\ServiceScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\AccountValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Class AccountService
 * @package App\Services
 */
class AccountService extends Service implements ServiceInterface, ScopableService
{
    use ServiceScopeTrait;

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
     * @throws ValidationException
     */
    public function create(array $data): Model
    {
        return $this->createNewAccount($data);
    }

    private function createNewAccount(array $data)
    {
        $account = null;
        DB::transaction(function () use ($data, &$account) {
            $userData    = Arr::get($data, 'user', []);
            $accountData = Arr::get($data, 'account', []);
            $account = parent::create($accountData);
            $this->setupManagerUserData($userData, $account);
            $user = app(UserService::class)->create($userData);
            parent::update(['manager_id' => $user->id], $account->id);
        });
        return $account;
    }

    /**
     * @param array $user_data
     * @param Account $account
     * @return void
     */
    private function setupManagerUserData(array &$user_data, Account $account)
    {
        $user_data['account_id'] = $account->id;
        $user_data['permission'] = User::MANAGER_PERMISSION;
    }

    /**
     * @param $data
     * @param $id
     * @return Model
     * @throws ValidationException
     */
    public function update($data, $id)
    {
        $item = $this->repository->read($id);
        $this->validateToUpdate($data, $id);
        return $this->repository->update($data, null, $item);
    }
}
