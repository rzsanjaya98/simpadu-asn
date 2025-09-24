<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rank extends Model
{
    public function employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
