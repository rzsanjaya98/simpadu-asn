<?php

namespace App\Models;

use App\Models\User;
use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveApproval extends Model
{
    protected $fillable = [
        'leave_request_id', 'supervisor_id', 'leader_id'
    ];

    function leave_request(): BelongsTo
    {
        return $this->belongsTo(LeaveRequest::class);
    }

    function leave_approval_supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    function leave_approval_leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}
