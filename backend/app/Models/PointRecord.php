<?php
namespace App\Models;

use App\Models\Base\PointRecordModel;
use App\Models\Contracts\ModelInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Account
 * @package App\Models
 *
 * @property int $id
 * @property Carbon $date
 * @property Carbon $hour
 * @property int $status
 * @property int $type
 * @property int $user_id
 *
 * @method User user()
 */
class PointRecord extends PointRecordModel implements ModelInterface
{
    public const APPROVED_STATUS = 1;

    public const ON_HOLD_STATUS = 2;

    /**
     * @return Collection
     */
    public function getStatuses(): Collection
    {
        return collect([
           self::APPROVED_STATUS,
           self::ON_HOLD_STATUS,
        ]);
    }
}
