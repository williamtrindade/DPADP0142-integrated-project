<?php

namespace App\Models;

use App\Models\Base\WorkingHourModel;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class WorkingHour
 * @package App\Models
 * @property int        $id
 * @property string     $name
 * @property string     $description
 * @property int        $user_id
 * @property int        $account_id
 *
 * @property Collection $timeBlocks
 * @property User       $user
 * @property Account    $account
 */
class WorkingHour extends WorkingHourModel
{

}
