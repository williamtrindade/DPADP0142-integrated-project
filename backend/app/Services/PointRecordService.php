<?php

namespace App\Services;

use App\Filters\Service\FilterableServiceInterface;
use App\Filters\Service\FilterTrait;
use App\Models\PointRecord;
use App\Models\TimeBlock;
use App\Models\User;
use App\Repositories\PointRecord\PointRecordRepositoryInterface;
use App\Scopes\Service\ScopableService;
use App\Scopes\Service\ServiceScopeTrait;
use App\Services\Base\Service;
use App\Services\Base\ServiceInterface;
use App\Validators\PointRecordValidator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PointRecordService extends Service implements ServiceInterface, ScopableService, FilterableServiceInterface
{
    use ServiceScopeTrait;
    use FilterTrait;

    /** @var PointRecordRepositoryInterface $repository */
    public $repository;

    /** @var PointRecordValidator $validator */
    public $validator;

    public function __construct(PointRecordRepositoryInterface $repository, PointRecordValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function allUnapproved(bool $paginate = true, int $page = 1, int $show = 15)
    {
        return $this->repository->allUnapproved($paginate, $page, $show);
    }

    /**
     * @param array $data
     * @return Model
     * @throws ValidationException
     */
    public function create(array $data): Model
    {
        // Validate Time
        $data['status'] = $this->validateTime($data['user_id']);

        // Validate Type
        $data['type'] = $this->validateType($data['user_id']);

        // Validate coordinates


        // Validate Status
        // $data['status'] = PointRecord::APPROVED_STATUS;

        //Create
        $this->validateToCreate($data);
        return $this->repository->create($data);
    }

    private function validateTime(int $user_id): int
    {
        // Convert to local timezone
        $nowHour = Carbon::now('America/Sao_Paulo')->toTimeString();

        /** @var User $user */
        $user = app(UserService::class)->read($user_id);

        if (is_null($user->workingHour)) {
            throw new UnprocessableEntityHttpException('Seu gestor não definiu uma carga para vocẽ!');
        }

        $timeBlocks = $user->workingHour->timeBlocks;

        $status = PointRecord::APPROVED_STATUS;
        $timeBlocks->each(function(TimeBlock $block) use ($nowHour, &$status) {
            if (!$this->inRange(
                    $block->start_hour,
                    $block->end_hour,
                    $nowHour
            )) {
                // throw new UnprocessableEntityHttpException('Você não pode bater ponto agora');
                $status = PointRecord::ON_HOLD_STATUS;
            }
        });
        return $status;
    }

    /**
     * Define if the now() is in range
     *
     * @param string $start_hour
     * @param string $end_hour
     * @param string $now
     * @return bool
     */
    private function inRange(string $start_hour, string $end_hour, string $now): bool
    {
        $inicioTimestamp = strtotime($start_hour);
        $fimTimestamp = strtotime($end_hour);
        $agoraTimestamp = strtotime($now);
        return (($agoraTimestamp >= $inicioTimestamp) && ($agoraTimestamp <= $fimTimestamp));
    }

    private function validateType(int $user_id): int
    {
        /** @var User $user */
        $user = app(UserService::class)->read($user_id);

        /** @var PointRecord $lastPointRecord*/
        $lastPointRecord = $user->pointRecords()->orderBy('id', 'desc')->first();

        if ($lastPointRecord)
            return ($lastPointRecord->type == PointRecord::EXIT_TYPE) ? PointRecord::ENTRANCE_TYPE : PointRecord::EXIT_TYPE;
        else
            return PointRecord::ENTRANCE_TYPE;
    }
}
