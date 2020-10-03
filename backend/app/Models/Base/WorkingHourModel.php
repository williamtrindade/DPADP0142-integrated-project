<?php

namespace App\Models\Base;

use App\Models\Account;
use App\Models\TimeBlock;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class WorkingHourModel
 * @package App\Models\Base
 */
class WorkingHourModel extends Model
{
    protected $table = 'working_hours';

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'account_id'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * @return HasMany
     */
    public function timeBlocks(): HasMany
    {
        return $this->hasMany(TimeBlock::class, 'working_hour_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(User::class, 'working_hour_id');
    }
}
