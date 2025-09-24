<?php

use App\Models\EmployeEducation;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\StoreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeEducationController;
use App\Http\Controllers\LeaveApprovalController;
use App\Http\Controllers\LeaveBalanceController;

Route::get('/', function () {
    return view('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['isSuperAdmin'])->group(function(){
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/user/add', [UserController::class, 'add']);
        Route::post('/user/create', [UserController::class, 'create']);
        Route::patch('/user/{id}/update_role', [UserController::class, 'update_role']);
        Route::get('/user/{id}/delete', [UserController::class, 'delete']);

        Route::post('/leavebalance/{id}/create', [LeaveBalanceController::class, 'create']);
        Route::patch('/leavebalance/{id}/update', [LeaveBalanceController::class, 'update']);
        Route::get('/leavebalance/{id}/delete', [LeaveBalanceController::class, 'delete']);
    });
    
    Route::patch('/user/{id}/update', [UserController::class, 'update']);
    Route::get('/user/{id}/detail', [UserController::class, 'show']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);

//    Route::get('/employeeeducation', [EmployeeEducationController::class, 'index']);
    Route::get('/employeeeducation/{id}/add', [EmployeeEducationController::class, 'add']);
    Route::post('/employeeeducation/{id}/create', [EmployeeEducationController::class, 'create']);
    Route::get('/employeeeducation/{id}/edit', [EmployeeEducationController::class, 'edit']);
    Route::patch('/employeeeducation/{id}/update', [EmployeeEducationController::class, 'update']);
    Route::get('/employeeeducation/{id}/delete', [EmployeeEducationController::class, 'delete']);
   
    Route::get('/leave_request', [LeaveRequestController::class, 'index'])->name('leave_request');
    Route::get('/leave_request/add', [LeaveRequestController::class, 'add']);
    Route::post('/leave_request/create', [LeaveRequestController::class, 'create']);
    Route::get('/leave_request/{id}/edit', [LeaveRequestController::class, 'edit']);
    Route::patch('/leave_request/{id}/update', [LeaveRequestController::class, 'update']);
    Route::get('/leave_request/{id}/delete', [LeaveRequestController::class, 'delete']);
    Route::get('/leave_request/{id}/save', [LeaveRequestController::class, 'save']);

    Route::middleware(['isAdmin'])->group(function(){
        Route::get('/leave_approval', [LeaveApprovalController::class, 'index'])->name('leave_approval');
        Route::patch('/leave_approval/{id}/leave_approved_supervisor', [LeaveApprovalController::class, 'leave_approved_supervisor']);
        Route::patch('/leave_approval/{id}/leave_rejected_supervisor', [LeaveApprovalController::class, 'leave_rejected_supervisor']);
        Route::patch('/leave_approval/{id}/leave_approved_leader', [LeaveApprovalController::class, 'leave_approved_leader']);
        Route::patch('/leave_approval/{id}/leave_rejected_leader', [LeaveApprovalController::class, 'leave_rejected_leader']);
    });
    

    // Route::get('/store', [StoreController::class, 'index'])->name('store');
    // Route::get('/store/add', [StoreController::class, 'add']);
    // Route::post('/store/create', [StoreController::class, 'create']);
    // Route::get('/store/{id}/detail', [StoreController::class, 'show']);
    // Route::get('/store/{id}/edit', [StoreController::class, 'edit']);
    // Route::patch('/store/{id}/update', [StoreController::class, 'update']);
    // Route::get('/store/{id}/delete', [StoreController::class, 'delete']);
    // Route::get('/store/{id}/restore', [StoreController::class, 'restore']); 
});

// Route::middleware(['guest'])->group(function () {
//     Route::get('/login', [AuthController::class, 'login'])->name('login');
//     Route::post('/login', [AuthController::class, 'authenticating']);
// });

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticating']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/test', function(){
    return "Hello";
});
