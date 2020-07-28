<?php

namespace App\Models;

use App\Models\Base\UserModel;
use App\Models\Contracts\ModelInterface;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * @package App\Models
 */
class User extends UserModel implements ModelInterface
{
}
