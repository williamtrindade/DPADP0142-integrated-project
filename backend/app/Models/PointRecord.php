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
 * @property int      $id
 * @property int      $status
 * @property int      $type
 * @property string   $lat
 * @property string   $lng
 * @property int      $user_id
 * @property int      $account_id
 * @property Carbon   $created_at
 *
 * @property User     $user
 * @property Account  $account
 */
class PointRecord extends PointRecordModel implements ModelInterface
{
    public const APPROVED_STATUS = 1;
    public const ON_HOLD_STATUS  = 2;
    public const REPROVED_STATUS = 3;

    public const ENTRANCE_TYPE   = 1;
    public const EXIT_TYPE       = 2;

    /**
     * @return Collection
     */
    public static function getStatuses(): Collection
    {
        return collect([
            self::APPROVED_STATUS,
            self::ON_HOLD_STATUS,
            self::REPROVED_STATUS,
        ]);
    }

    /***
     * @return Collection
     */
    public static function getTypes(): Collection
    {
        return collect([
            self::ENTRANCE_TYPE,
            self::EXIT_TYPE,
        ]);
    }
}
