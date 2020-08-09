<?php

namespace App\Models\Base;

use App\Models\PointRecord;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class UserModel
 * @package App\Models\Base
 */
class UserModel extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /** @var string $table */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permission',
        'account_id',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(AccountModel::class, 'account_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function pointRecords(): HasMany
    {
        return $this->hasMany(PointRecord::class, 'user_id', 'id');
    }
}
