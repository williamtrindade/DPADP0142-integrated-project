<?php

namespace App\Models\Base;

use App\Models\Account;
use App\Models\PointRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class LocationModel
 * @package App\Models\Base
 */
class LocationModel extends Model
{
    /** @var string $table */
    protected $table = 'locations';

    /** @var string[] $fillable */
    protected $fillable = [
        'lat',
        'lng',
        'point_record_id',
        'account_id',
    ];

    /**
     * @return HasOne
     */
    public function pointRecord(): HasOne
    {
        return $this->hasOne(PointRecord::class);
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
