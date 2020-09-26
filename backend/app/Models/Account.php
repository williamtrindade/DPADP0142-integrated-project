<?php

namespace App\Models;

use App\Models\Base\AccountModel;
use App\Models\Contracts\ModelInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Account
 * @package App\Models
 * @property int        $id
 * @property string     name
 * @property string     $cnpj
 * @property string     $address
 * @property string     $cep
 * @property string     $phone
 * @property int        $manager_id
 *
 * @property User       $manager
 * @property Collection $users
 * @property Collection $pointRecords
 * @property Collection $locations
 * @property Collection $timeBlocks
 * @property Collection $workingHours
 */
class Account extends AccountModel implements ModelInterface
{
    //
}
