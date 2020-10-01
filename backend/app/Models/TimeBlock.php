<?php

namespace App\Models;

use App\Models\Base\TimeBlockModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Class TimeBlock
 * @package App\Models
 * @property Carbon      $start_hour
 * @property Carbon      $end_hour
 * @property string      $week_days
 * @property int         $working_hour_id
 * @property int         $account_id
 *
 * @property WorkingHour $workingHour
 * @property Account     $account
 */
class TimeBlock extends TimeBlockModel
{
    public const MONDAY_WEEKDAY    = 0;
    public const TUESDAY_WEEKDAY   = 1;
    public const WEDNESDAY_WEEKDAY = 2;
    public const THURSDAY_WEEKDAY  = 3;
    public const FRIDAY_WEEKDAY    = 4;
    public const SATURDAY_WEEKDAY  = 5;
    public const SUNDAY_WEEKDAY    = 6;

    /**
     * @return Collection
     */
    public static function getWeekDaysValues()
    {
        return collect([
            self::MONDAY_WEEKDAY,
            self::TUESDAY_WEEKDAY,
            self::WEDNESDAY_WEEKDAY,
            self::THURSDAY_WEEKDAY,
            self::FRIDAY_WEEKDAY,
            self::SATURDAY_WEEKDAY,
            self::SUNDAY_WEEKDAY,
        ]);
    }

    /**
     * @param $value
     */
    public function setWeekDaysAttribute($value)
    {
        $data = collect($value)->map(function($day) {
            return ['id' => $day['id'], 'value' => $day['value']];
        });
        $this->attributes['week_days'] = json_encode($data->toArray());
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getWeekDaysAttribute($value)
    {
        return json_decode($value);
    }
}
