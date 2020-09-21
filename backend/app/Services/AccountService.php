<?php

namespace App\Services;

use App\Models\Account;
use App\Models\User;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Scopes\Service\ScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\AccountValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class AccountService
 * @package App\Services
 */
class AccountService extends Service implements ServiceInterface
{
    use ScopeTrait;

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
        return $this->createNewAccount($data);
    }

    /**
     * @param array $data
     * @return Account
     */
    private function createNewAccount(array $data)
    {
        $this->validator::validateToCreateGuest($data);
        [$user_data, $account_data] = $this->getAccountAndUserData($data);
        $account = null;
        DB::transaction(function() use (&$user_data, &$account_data, &$account) {
            // Create Account
            /** @var Account $account */
            $account = parent::create($account_data);
            // Setup User
            $user_data['password'] = Hash::make($user_data['password']);
            $user_data['account_id'] = $account->id;
            $user_data['permission'] = User::MANAGER_PERMISSION;
            /** @var User $user */
            $user = app(UserRepositoryInterface::class)->create($user_data);
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
     * @param array $data
     * @return array[]
     */
    private function getAccountAndUserData(array $data): array
    {
        $user_data = [];
        $account_data = [];
        collect($data)->each(function ($value, $key) use (&$user_data, &$account_data) {
            if (Str::startsWith($key, 'user_')) {
                $user_data[Str::replaceFirst('user_', '', $key)] = $value;
            } elseif(Str::startsWith($key, 'account_')) {
                $account_data[Str::replaceFirst('account_', '', $key)] = $value;
            }
        });
        return [$user_data, $account_data];
    }
}
