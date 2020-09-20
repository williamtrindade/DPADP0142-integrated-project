<?php

namespace App\Models\Base;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class EmployeeInvitationModel
 * @package App\Models\Base
 */
class EmployeeInvitationModel extends Model
{
    protected $table = 'employee_invites';

    protected $fillable = [
        'hash',
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
