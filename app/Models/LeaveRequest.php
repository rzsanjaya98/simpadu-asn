<?php

namespace App\Models;

use App\Models\User;
use App\Models\TypeLeave;
use App\Models\LeaveApproval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    protected $fillable = [
        'user_id', 'type_leave_id', 'reason', 'start_date', 'end_date', 'address', 'amount_days'
    ];

    function type_leave(): BelongsTo
    {
        return $this->belongsTo(TypeLeave::class);
    }

    function leave_approval(){
        return $this->hasOne(LeaveApproval::class);
    }

    function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
