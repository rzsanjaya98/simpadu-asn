<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeaveBalance;
use Illuminate\Auth\Access\Response;

class LeaveBalancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LeaveBalance $leaveBalance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role_id === 1
                ? Response::allow()
                : Response::deny('Only SuperAdmin can Access');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LeaveBalance $leaveBalance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LeaveBalance $leaveBalance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LeaveBalance $leaveBalance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LeaveBalance $leaveBalance): bool
    {
        return false;
    }
}
