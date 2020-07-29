<?php

namespace App\Models;

use App\Models\Base\UserModel;
use App\Models\Contracts\ModelInterface;
use Illuminate\Support\Collection;

/**
 * Class User
 * @package App\Models
 */
class User extends UserModel implements ModelInterface
{
    public const MANAGER_PERMISSION = 1;
    public const EMPLOYEE_PERMISSION = 0;

    /**
     * @return Collection
     */
    public function getPermissions(): Collection
    {
        return collect([
            self::MANAGER_PERMISSION, self::EMPLOYEE_PERMISSION
        ]);
    }
}
