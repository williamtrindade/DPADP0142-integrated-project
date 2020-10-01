<?php

namespace App\Services;

use App\Business\CreateWorkingHourBusiness;
use App\Filters\Service\FilterableServiceInterface;
use App\Filters\Service\FilterTrait;
use App\Models\WorkingHour;
use App\Repositories\WorkingHour\WorkingHourRepositoryInterface;
use App\Scopes\ScopableService;
use App\Scopes\Service\ServiceScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\WorkingHourValidator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

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
        $this->validator  = $validator;
    }

    /**
     * @param array $data
     * @return WorkingHour
     */
    public function create(array $data)
    {
        if (Arr::get($data, 'working_hour', false) && Arr::get($data, 'time_blocks', false)) {
            $working_hour = null;
            DB::transaction(function() use ($data, &$working_hour) {
                $working_hour = $this->createWorkingHour($data);
                $this->createTimeBlocks($data, $working_hour->id);
                CreateWorkingHourBusiness::canCreate($working_hour);
            });
            return $working_hour;
        }
        throw new UnprocessableEntityHttpException('The working_hour and time_blocks fields is required');
    }

    /**
     * @param array $data
     * @return WorkingHour
     * @throws ValidationException
     */
    private function createWorkingHour(array $data): WorkingHour
    {
        $data_to_create = collect($data['working_hour'])->merge([
            'account_id' => $data['account_id'],
            'user_id'    => $data['user_id'],
        ]);
        return parent::create($data_to_create->toArray());
    }

    /**
     * @param array $data
     * @param int $working_hour_id
     * @return void
     */
    private function createTimeBlocks(array $data, int $working_hour_id)
    {
        collect($data['time_blocks'])->each(function($time_block) use ($working_hour_id, $data) {
            $data_to_create = collect($time_block)->merge([
                'account_id'      => $data['account_id'],
                'working_hour_id' => $working_hour_id,
            ]);
            app(TimeBlockService::class)->create($data_to_create->toArray());
        });
    }
}
