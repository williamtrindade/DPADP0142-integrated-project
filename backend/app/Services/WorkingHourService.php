<?php

namespace App\Services;

use App\Filters\Service\FilterableServiceInterface;
use App\Filters\Service\FilterTrait;
use App\Repositories\WorkingHour\WorkingHourRepositoryInterface;
use App\Scopes\ScopableService;
use App\Scopes\Service\ServiceScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\WorkingHourValidator;

/**
 * Class WorkingHourService
 * @package App\Services
 */
class WorkingHourService extends Service implements ServiceInterface, ScopableService, FilterableServiceInterface
{
    use FilterTrait;
    use ServiceScopeTrait;

    /** @var WorkingHourRepositoryInterface $repository */
    public $repository;

    /** @var WorkingHourValidator $validator */
    public $validator;

    /**
     * UserService constructor.
     * @param WorkingHourRepositoryInterface $repository
     * @param WorkingHourValidator $validator
     */
    public function __construct(WorkingHourRepositoryInterface $repository, WorkingHourValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
}
