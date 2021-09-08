<?php

namespace App\Models\Base;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointRecordModel extends Model
{
    protected $table = 'point_records';

    /**
     * @var array
     */
    protected $fillable = [
        'status',
        'type',
        'user_id',
        'account_id',
        'lat',
        'lng',
    ];

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
