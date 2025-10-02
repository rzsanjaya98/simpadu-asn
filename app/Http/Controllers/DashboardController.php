<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index() {
        $jabatan = User::with('employee', 'employee.position', 'employee.rank')->get();
        $positions = Position::with('employee.users', 'type_position')->whereIn('type_position_id', [2,3,4])->orderBy('id', 'asc')->get();
        // $positions = DB::table('positions')->whereIn('type_position_id', [2,3])->orderBy('id')->get();
        $ranks = Rank::withCount('employee')
                        ->get()
                        ->groupBy('rank_group')
                        ->map(function ($items, $group) {
                            return [
                                'rank_group' => $group,
                                'employee_count' => $items->sum('employee_count'),
                            ];
                        })
                        ->values()
                        ->toArray();
        
        $employee = DB::table('employees')->count();

        // $user = Auth::user();
        // return $positions;
        return view('admin_dashboard.dashboard', ['positions' => $positions, 'ranks' => $ranks, 'employee' => $employee]);
    }
}
