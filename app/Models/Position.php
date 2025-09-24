<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\TypePosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Position extends Model
{
    function type_position(): BelongsTo
    {
        return $this->belongsTo(TypePosition::class);
    }

    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
