<?php

namespace App\Models;

use App\Models\Base\AccountModel;
use App\Models\Contracts\ModelInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Account
 * @package App\Models
 * @property int $id
 * @property string name
 * @property string $cnpj
 * @property string $address
 * @property string $cep
 * @property string $phone
 * @property int $manager_id
 *
 * @method User manager()
 * @method Collection users()
 * @method Collection pointRecords()
 * @method Collection locations()
 */
class Account extends AccountModel implements ModelInterface
{
    //
}
