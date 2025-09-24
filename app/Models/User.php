<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveApproval;
use App\Models\EmployeeEducation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    function employee(){
        return $this->hasOne(Employee::class);
    }

    // function parent(): BelongsTo
    // {
    //     return $this->belongsTo(Employee::class, 'parent_id');
    // }

    function education(){
        return $this->hasMany(EmployeeEducation::class);
    }
    
    function leave_balance(){
        return $this->hasMany(LeaveBalance::class);
    }

    function leave_request(){
        return $this->hasMany(LeaveRequest::class);
    }

    function leave_approval_supervisor(){
        return $this->hasMany(LeaveApproval::class, 'supervisor_id');
    }

    function leave_approval_leader(){
        return $this->hasMany(LeaveApproval::class, 'leader_id');
    }

    function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
