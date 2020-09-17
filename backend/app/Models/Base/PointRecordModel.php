<?php

namespace App\Models\Base;

use App\Models\Account;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class PointRecordModel
 * @package App\Models\Base
 */
class PointRecordModel extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'hour',
        'status',
        'type',
        'location_id',
        'user_id',
        'account_id',
    ];

    /**
     * @var string[] $dates
     */
    protected $dates = [
        'date',
        'hour',
    ];

    /**
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::class, 'point_record_id');
    }


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
