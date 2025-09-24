<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Models\LeaveApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LeaveApprovalController extends Controller
{
    function index()
    {
        $menu_name = 'Cuti';
        // return $data_user->employee->position->position_name;
        // $data_user = User::with('employee.position')->where('user_')->get();
        // $leave_approval = LeaveRequest::with('type_leave', 'leave_approval', 'users.employee.position')->get();

        // if(Auth::user()->role_id != 3){
        //     $data_user = User::with('employee.position')->find(Auth::id());
        //     if ($data_user->employee->position != null) {
        //         if ($data_user->employee->position?->type_position->level_position === '3' || $data_user->employee->position?->type_position->level_position === '4') {
        //             $leave_approval = LeaveApproval::with('leave_request.type_leave', 'leave_request.users.employee')->where('supervisor_id', Auth::id())->orderBy('id', 'desc')->get();
        //             return view('admin_dashboard.leave.leave_approval_supervisor', ['menu_name' => $menu_name, 'leave_approval' => $leave_approval]);
        //         }

        //         if ($data_user->employee->position?->position_name == 'Kepala Badan Perencanaan Pembangunan Daerah') {
        //             $leave_approval = LeaveApproval::with('leave_request.type_leave', 'leave_request.users.employee')->orderBy('id', 'desc')->get();
        //             return view('admin_dashboard.leave.leave_approval_leader', ['menu_name' => $menu_name, 'leave_approval' => $leave_approval]);
        //         }
        //     }else{
        //         return back();    
        //     }
        // }else{
        //     return back();
        // }

        if(Auth::user()->role_id != 3){
            $data_user = User::with('employee.position')->find(Auth::id());
            if ($data_user->employee->position != null) {
                if ($data_user->employee->position?->type_position->level_position <= '4') {
                    $leave_approval_supervisor = LeaveApproval::with('leave_request.type_leave', 'leave_request.users.employee')->where('supervisor_id', Auth::id())->orderBy('id', 'desc')->get();
                    if($data_user->employee->position?->type_position->level_position === '2'){
                        $leave_approval_leader = LeaveApproval::with('leave_request.type_leave', 'leave_request.users.employee')->orderBy('id', 'desc')->get();
                        return view('admin_dashboard.leave.leave_approvals', ['menu_name' => $menu_name, 'leave_approval_supervisor' => $leave_approval_supervisor, 'leave_approval_leader' => $leave_approval_leader]);
                    }
                    return view('admin_dashboard.leave.leave_approvals', ['menu_name' => $menu_name, 'leave_approval_supervisor' => $leave_approval_supervisor]);
                }

                // if ($data_user->employee->position?->position_name == 'Kepala Badan Perencanaan Pembangunan Daerah') {
                //     $leave_approval = LeaveApproval::with('leave_request.type_leave', 'leave_request.users.employee')->orderBy('id', 'desc')->get();
                //     return view('admin_dashboard.leave.leave_approval_leader', ['menu_name' => $menu_name, 'leave_approval' => $leave_approval]);
                // }
            }else{
                return back();    
            }
        }else{
            return back();
        }

        // $data_user = User::with('employee.position')->find(Auth::id());
        // if ($data_user->employee != null) {
        //     if ($data_user->employee->position?->position_name == 'Kepala Sub Bagian Umum dan Kepegawaian') {
        //         $leave_approval = LeaveApproval::with('leave_request.type_leave', 'leave_request.users.employee')->orderBy('id', 'desc')->get();
        //         return view('admin_dashboard.leave.leave_approval_supervisor', ['menu_name' => $menu_name, 'leave_approval' => $leave_approval]);
        //     }

        //     if ($data_user->employee->position?->position_name == 'Kepala Badan Perencanaan Pembangunan Daerah') {
        //         $leave_approval = LeaveApproval::with('leave_request.type_leave', 'leave_request.users.employee')->orderBy('id', 'desc')->get();
        //         return view('admin_dashboard.leave.leave_approval_leader', ['menu_name' => $menu_name, 'leave_approval' => $leave_approval]);
        //     }
        // }
        // return view('admin_dashboard.dashboard');
    }

    function leave_approved_supervisor($id)
    {
        // return $id;
        LeaveApproval::where('leave_request_id', $id)->where('supervisor_id', Auth::id())->update([
            // 'supervisor_id' => Auth::user()->id,
            'supervisor_status' => 'approved',
            'supervisor_note' => null
        ]);

        Session::flash('message', 'Leaves Successfully Approved');

        return redirect()->route('leave_approval');
    }

    function leave_rejected_supervisor(Request $request, $id)
    {
        LeaveApproval::where('leave_request_id', $id)->where('supervisor_id', Auth::id())->update([
            // 'supervisor_id' => Auth::user()->id,
            'supervisor_status' => 'rejected',
            'supervisor_note' => $request->supervisor_note,
            'leader_status' => 'rejected',
        ]);

        LeaveRequest::where('id', $id)->update([
            'status' => 'rejected'
        ]);

        Session::flash('message', 'Leaves Successfully Rejected');

        return redirect()->route('leave_approval');
    }

    function leave_approved_leader($id)
    {
        LeaveApproval::where('leave_request_id', $id)->update([
            'leader_id' => Auth::user()->id,
            'leader_status' => 'approved',
            'leader_note' => null
        ]);

        LeaveRequest::where('id', $id)->update([
            'status' => 'approved'
        ]);
        
        $leave = LeaveApproval::with('leave_request')->where('leave_request_id', $id)->firstOrFail();
        $this->deductLeave($leave->leave_request->user_id, $leave->leave_request->amount_days);

        Session::flash('message', 'Leaves Successfully Approved');

        return redirect()->route('leave_approval');
    }

    function leave_rejected_leader(Request $request, $id)
    {
        LeaveApproval::where('leave_request_id', $id)->update([
            'leader_id' => Auth::user()->id,
            'leader_status' => 'rejected',
            'leader_note' => $request->leader_note,
            'supervisor_status' => 'rejected',
        ]);

        LeaveRequest::where('id', $id)->update([
            'status' => 'rejected'
        ]);

        Session::flash('message', 'Leaves Successfully Rejected');

        return redirect()->route('leave_approval');
    }

    function deductLeave($userId, $daysRequested)
    {
        $balances = LeaveBalance::where('user_id', $userId)
            ->where('remaining_leave', '>', 0)
            ->orderBy('year') // tahun lama dulu
            ->get();

        if ($balances->isEmpty()) {
            throw new \Exception("Pastikan jumlah cuti telah diinput terlebih dahulu");
            // return back()->withErrors(['amount_days' => 'Pastikan jumlah cuti telah diinput terlebih dahulu']);
        }

        foreach ($balances as $balance) {
            if ($daysRequested <= 0) break;

            $deduct = min($balance->remaining_leave, $daysRequested);
            $balance->decrement('remaining_leave', $deduct);
            $daysRequested -= $deduct;
        }

        if ($daysRequested > 0) {
            // return back()->withErrors(['amount_days' => 'Cuti tidak mencukupi']);
            throw new \Exception("Cuti tidak mencukupi");
        }
    }
}
