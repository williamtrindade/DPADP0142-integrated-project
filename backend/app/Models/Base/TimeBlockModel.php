<?php

namespace App\Models\Base;

use App\Models\Account;
use App\Models\WorkingHour;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TimeBlockModel
 * @package App\Models\Base
 */
class TimeBlockModel extends Model
{
    protected $table = 'time_blocks';

    protected $fillable = [
        'start_hour',
        'end_hour',
        'week_days',
        'working_hour_id',
        'account_id',
    ];

    protected $casts = [
        'end_hour'  => 'time',
        'week_days' => 'time',
    ];

    /**
     * @return BelongsTo
     */
    public function workingHour(): BelongsTo
    {
        return $this->belongsTo(WorkingHour::class, 'working_hour_id');
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
