<?php

namespace App\Models\Base;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
