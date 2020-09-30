<?php

namespace App\Services;

use App\Models\Account;
use App\Models\User;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Scopes\ScopableService;
use App\Scopes\Service\ServiceScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\AccountValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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

    /**
     * @param array $data
     * @return Account
     * @throws ValidationException
     */
    private function createNewAccount(array $data)
    {
        $this->validator::validateToCreateGuest($data);
        $account_data = $this->getAccountData($data);
        $user_data = $this->getUserData($data);
        $account = null;
        DB::transaction(function() use (&$user_data, &$account_data, &$account) {
            // Create Account
            /** @var Account $account */
            $account = parent::create($account_data);
            $this->setupManagerUserData($user_data, $account);
            /** @var User $user */
            $user = app(UserService::class)->create($user_data);
            parent::update(['manager_id' => $user->id], $account->id);
        });
        return $account;
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
     * Get user data
     *
     * @param array $data
     * @return array
     */
    private function getUserData(array $data): array
    {
        $user_data = [];
        collect($data)->each(function ($value, $key) use (&$user_data) {
            if (Str::startsWith($key, 'user_')) {
                $user_data[Str::replaceFirst('user_', '', $key)] = $value;
            }
        });
        return $user_data;
    }

    /**
     * Get account data
     *
     * @param array $data
     * @return array
     */
    private function getAccountData(array $data): array
    {
        $account_data = [];
        collect($data)->each(function ($value, $key) use (&$account_data) {
            if(Str::startsWith($key, 'account_')) {
                $account_data[Str::replaceFirst('account_', '', $key)] = $value;
            }
        });
        return $account_data;
    }
}
