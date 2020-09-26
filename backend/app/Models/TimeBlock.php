<?php

namespace App\Models;

use App\Models\Base\TimeBlockModel;
use Carbon\Carbon;

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

}
