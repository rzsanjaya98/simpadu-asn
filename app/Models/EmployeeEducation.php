<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    protected $fillable = [
        'user_id', 'education_level', 'major', 'graduate'
    ];
}
