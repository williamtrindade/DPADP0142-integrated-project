<?php

namespace App\Services;

use App\Filters\Service\FilterableServiceInterface;
use App\Filters\Service\FilterTrait;
use App\Repositories\TimeBlock\TimeBlockRepositoryInterface;
use App\Scopes\ScopableService;
use App\Scopes\Service\ServiceScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\TimeBlockValidator;

/**
 * Class TimeBlockService
 * @package App\Services
 */
class TimeBlockService extends Service implements ServiceInterface, ScopableService, FilterableServiceInterface
{
    use ServiceScopeTrait;
    use FilterTrait;

    /** @var TimeBlockRepositoryInterface $repository */
    public $repository;

    /** @var TimeBlockValidator $validator */
    public $validator;

    /**
     * UserService constructor.
     * @param TimeBlockRepositoryInterface $repository
     * @param TimeBlockValidator $validator
     */
    public function __construct(TimeBlockRepositoryInterface $repository, TimeBlockValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
}
