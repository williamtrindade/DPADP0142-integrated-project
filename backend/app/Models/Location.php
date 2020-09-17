<?php

namespace App\Models;

use App\Models\Base\LocationModel;

/**
 * Class Location
 * @package App\Models
 *
 * @property string $lat
 * @property string $lng
 * @property int $account_id
 * @property int $point_record_id
 *
 * @method PointRecord pointRecord()
 * @method Account account()
 */
class Location extends LocationModel
{
}
