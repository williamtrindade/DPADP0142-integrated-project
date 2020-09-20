<?php

namespace App\Models;

use App\Models\Base\EmployeeInviteModel;

/**
 * Class EmployeeInvite
 * @package App\Models
 *
 * @property string $hash
 * @property int $user_id
 *
 * @property User $user
 */
class EmployeeInvite extends EmployeeInviteModel
{
    /**
     * @return Account
     */
    public function account(): Account
    {
        return $this->user->account;
    }
}
