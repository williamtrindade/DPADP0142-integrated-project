<?php

namespace App\Providers;

use     App\Repositories\Account\AccountEloquentRepository;
use App\Repositories\Account\AccountRepositoryInterface;
use App\Repositories\EmployeeInvitation\EmployeeInvitationEloquentRepository;
use App\Repositories\EmployeeInvitation\EmployeeInvitationRepositoryInterface;
use App\Repositories\PointRecord\PointRecordEloquentRepository;
use App\Repositories\PointRecord\PointRecordRepositoryInterface;
use App\Repositories\TimeBlock\TimeBlockEloquentRepository;
use App\Repositories\TimeBlock\TimeBlockRepositoryInterface;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\WorkingHour\WorkingHourEloquentRepository;
use App\Repositories\WorkingHour\WorkingHourRepositoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * ----------------------------------------------
         * Repositories Bind
         * ______________________________________________
         */
        $this->app->bind(UserRepositoryInterface::class,UserEloquentRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountEloquentRepository::class);
        $this->app->bind(EmployeeInvitationRepositoryInterface::class, EmployeeInvitationEloquentRepository::class);
        $this->app->bind(WorkingHourRepositoryInterface::class, WorkingHourEloquentRepository::class);
        $this->app->bind(TimeBlockRepositoryInterface::class, TimeBlockEloquentRepository::class);
        $this->app->bind(PointRecordRepositoryInterface::class, PointRecordEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
