<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\WorkingHour;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\WorkingHour\WorkingHourRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Throwable;

/**
 * Class UserEloquentRepository
 * @package App\Repositories\User
 */
class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /** @var User $model */
    public $model;

    /**
     * UserEloquentRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param bool $paginate
     * @param int $page
     * @param int $show
     * @return mixed
     */
    public function all(bool $paginate = true, int $page = 1, int $show = 15)
    {
        if ($paginate) {
            $this->queryBuilder = $this->queryBuilder()->with(array('workingHour'));
            return $this->paginate($page, $show);
        }
        return $this->queryBuilder()->with('workingHour')->get();
    }

    /**
     * @param int $userId
     * @param int $workingHourId
     * @return bool
     * @throws Throwable
     */
    public function updateWorkingHour(int $userId, int $workingHourId)
    {
        /** @var User $user */
        $user = $this->read($userId);

        /** @var WorkingHour $workingHour */
        $workingHour = app(WorkingHourRepositoryInterface::class)
            ->queryBuilder()
            ->where('account_id', '=', $user->account_id)
            ->where('id', '=', $workingHourId)
            ->firstOrFail();

        $user->working_hour_id = $workingHour->id;
        return $user->saveOrFail();
    }
}
