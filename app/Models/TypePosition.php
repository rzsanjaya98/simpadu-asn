<?php

namespace App\Models;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypePosition extends Model
{
    protected $table = 'type_position';

    public function position(): HasMany
    {
        return $this->hasMany(Position::class);
    }
}
