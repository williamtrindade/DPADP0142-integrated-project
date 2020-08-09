<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class AccountModel
 * @package App\Models\Base
 */
class AccountModel extends Model
{
    /** @var string $table */
    protected $table = 'accounts';

    /** @var string[] $fillable */
    protected $fillable = [
        'name',
        'cnpj',
        'address',
        'cep',
        'manager_id',
        'phone',
    ];

    /**
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'manager_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'account_id', 'id');
    }
}
