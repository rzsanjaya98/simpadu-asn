<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeLeave extends Model
{
    public function leave_request(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
