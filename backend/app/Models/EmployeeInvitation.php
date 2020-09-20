<?php

namespace App\Models;

use App\Models\Base\EmployeeInvitationModel;

/**
 * Class EmployeeInvitation
 * @package App\Models
 *
 * @property string $hash
 * @property int $user_id
 *
 * @property User $user
 */
class EmployeeInvitation extends EmployeeInvitationModel
{
    /**
     * @return Account
     */
    public function account(): Account
    {
        return $this->user->account;
    }
}
