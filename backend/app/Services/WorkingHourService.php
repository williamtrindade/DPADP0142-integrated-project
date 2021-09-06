<?php

namespace App\Services;

use App\Filters\Service\FilterableServiceInterface;
use App\Filters\Service\FilterTrait;
use App\Models\TimeBlock;
use App\Models\WorkingHour;
use App\Repositories\WorkingHour\WorkingHourRepositoryInterface;
use App\Scopes\Service\ScopableService;
use App\Scopes\Service\ServiceScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\WorkingHourValidator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
     * @return WorkingHour|null
     * @throws ValidationException
     */
    public function create(array $data)
    {
        $this->validator->validateCreationFields($data);
        $working_hour = null;
        DB::transaction(function() use ($data, &$working_hour) {
            $working_hour = parent::create($this->getWorkingHourData($data));
            $this->getTimeBlocksData($data, $working_hour->id)->each(function($time_block) {
                app(TimeBlockService::class)->create($time_block);
            });
        });
        return $working_hour;
    }

    /**
     * @param array $data
     * @param int $id
     * @return WorkingHour
     * @throws ValidationException
     */
    public function update(array $data, int $id)
    {
        $this->validator->validateCreationFields($data);
        $working_hour = null;
        DB::transaction(function() use ($id, $data, &$working_hour) {

            // update working hour
            /** @var WorkingHour $working_hour */
            $working_hour = parent::update($this->getWorkingHourData($data), $data['working_hour']['id']);

            // Ids of time Blocks
            $ids = collect($data['time_blocks'])->reject(function($time_block) {
                return Arr::get($time_block, 'id', false) ? false : true;
            })->map(function($time_block) {
                return $time_block['id'];
            })->toArray();

            // Iterate database
            $working_hour->timeBlocks->each(function(TimeBlock $database_time_block) use ($ids, $data) {
                if (in_array($database_time_block->id, $ids)) {
                    $time_block = collect($data['time_blocks'])->filter(function ($time_block) use ($database_time_block) {
                        return (Arr::get($time_block, 'id', null) == $database_time_block->id);
                    })->first();
                    app(TimeBlockService::class)->update($time_block, $database_time_block->id);
                } else {
                    app(TimeBlockService::class)->delete($database_time_block->id);
                }
            });

            // Create datas wihtout id
            $this->getTimeBlocksData($data, $working_hour->id)->each(function($time_block) {
                if (!Arr::get($time_block, 'id', false)) {
                    app(TimeBlockService::class)->create($time_block);
                }
            });
        });
        return $working_hour;
    }

    /**
     * @param array $data
     * @return array
     */
    private function getWorkingHourData(array $data): array
    {
        return collect($data['working_hour'])->merge([
            'account_id' => $data['account_id'],
            'user_id'    => $data['user_id'],
        ])->toArray();
    }

    /**
     * @param array $data
     * @param int $working_hour_id
     * @return Collection
     */
    private function getTimeBlocksData(array $data, int $working_hour_id): Collection
    {
        return collect($data['time_blocks'])->map(function($time_block) use ($working_hour_id, $data, &$time_block_data) {
            return collect($time_block)->merge([
                'account_id'      => $data['account_id'],
                'working_hour_id' => $working_hour_id,
            ])->toArray();
        });
    }
}
