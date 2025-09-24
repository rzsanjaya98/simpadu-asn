<?php

namespace App\Models;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'user_id', 'nip', 'gender', 'place_of_birth', 'date_of_birth', 'status', 'tmt_cpns'
    ];

    function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    function parent(){
        return $this->belongsTo(User::class, 'parent_id');
    }
    
}
