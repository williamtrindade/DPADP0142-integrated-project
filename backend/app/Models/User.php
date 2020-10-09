<?php

namespace App\Models;

use App\Models\Base\UserModel;
use App\Models\Contracts\ModelInterface;
use DateTime;
use Illuminate\Support\Collection;

/**
 * Class User
 * @package App\Models
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string      $password
 * @property string      $lat
 * @property string      $lng
 * @property string      $address
 * @property string      $remember_token
 * @property Datetime    $email_verified_at
 * @property int         $permission
 * @property string      $phone
 * @property string      $cpf
 * @property string      $created_at
 * @property int         $account_id
 * @property int         $working_hour_id
 *
 * @property Account     $account
 * @property Collection  $pointRecords
 * @property Collection  $workingHours
 * @property WorkingHour $workingHour
 */
class User extends UserModel implements ModelInterface
{
    public const MANAGER_PERMISSION  = 1;
    public const EMPLOYEE_PERMISSION = 2;

    /**
     * @return Collection
     */
    public function getPermissions(): Collection
    {
        return collect([
            self::MANAGER_PERMISSION,
            self::EMPLOYEE_PERMISSION
        ]);
    }
}
