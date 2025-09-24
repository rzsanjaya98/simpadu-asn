<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Rank;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeEducation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function index()
    {
        $menu_name = 'User / Employee';
        // $userlist = User::with('employee', 'employee.position', 'employee.rank')->whereHas('employee.position', function ($q) {
        //                 $q->where('type_position_id', 13);
        //             })->get();
        $userlist = User::with('role', 'employee', 'employee.position', 'employee.rank')->get();
        $roles = DB::table('roles')->get();
        // return $userlist;
        return view('admin_dashboard.user.user', ['users' => $userlist, 'menu_name' => $menu_name, 'roles' => $roles]);
    }

    function add()
    {
        $menu_name = 'User / Employee';
        return view('admin_dashboard.user.add_user', ['menu_name' => $menu_name]);
    }

    function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'nip' => 'required|string|min:18|unique:employees,nip',
            'gender' => 'required|string',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'status' => 'required|string',
            'tmt_cpns' => 'required|date'
        ]);

        // return $request;

        DB::transaction(function () use ($request) {
            // Simpan ke tabel users
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Simpan ke tabel profiles (dengan relasi ke users)
            Employee::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'gender' => $request->gender,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'status' => $request->status,
                'tmt_cpns' => $request->tmt_cpns,
            ]);

            // EmployeeEducation::create([
            //     'user_id' => $user->id,
            // ]);
        });
        // Store::create($request->all());

        Session::flash('message', 'New User/Employee Successfully Added');

        return redirect()->route('user');
    }

    function edit($id)
    {
        $menu_name = 'User / Employee';
        $edit = User::with('employee', 'employee.position', 'employee.rank')->findOrFail($id);
        $ranks = DB::table('ranks')->get();
        $userlists = User::with(['employee.position' => function ($q) {
                                    $q->whereIn('type_position_id', [2, 3]);
                                }])
                                ->whereHas('employee.position', function ($q) {
                                    $q->whereIn('type_position_id', [2, 3]);
                                })
                                ->get();
        $divisions = DB::table('divisions')->get();
        $positions = DB::table('positions')->orderBy('type_position_id')->get();
        // return $userlists;
        return view('admin_dashboard.user.edit_user', ['edit' => $edit, 'ranks' => $ranks, 'positions' => $positions, 'userlists' => $userlists, 'divisions' => $divisions, 'menu_name' => $menu_name]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email,' . $id . '',
            // 'password' => 'required|min:8|confirmed',
            'nip' => 'required|string|min:18|unique:employees,nip,' . $id . ',user_id',
            'gender' => 'required|string',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'status' => 'required|string',
            'tmt_cpns' => 'required|date',
        ]);

        // User::with('employee')->findOrFail($id);

        if ($request->password != '') {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }else{
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        Employee::where('user_id', $id)->update([
            'nip' => $request->nip,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'status' => $request->status,
            'tmt_cpns' => $request->tmt_cpns,
            'no_karpeg' => $request->no_karpeg,
            'rank_id' => $request->rank_id,
            'tmt_rank' => $request->tmt_rank,
            'position_id' => $request->position_id,
            'tmt_position' => $request->tmt_position,
            'parent_id' => $request->parent_id,
            'division_id' => $request->division_id,
            'working_time_year' => $request->working_time_year,
            'working_time_month' => $request->working_time_month,
        ]);


        Session::flash('message', 'User/Employee Successfully Updated');

        return redirect('/user/' . $id . '/detail');
    }

    function delete($id)
    {
        User::with('employee', 'education')->findOrFail($id)->delete();

        Session::flash('message', 'User / Employee Successfully Deleted');

        return redirect()->route('user');
    }

    function show($id)
    {
        $menu_name = 'User / Employee';
        $detail = User::with('employee', 'education', 'leave_balance')->findOrFail($id);
        // return $detail;
        return view('admin_dashboard.user.detail_user', ['detail' => $detail, 'menu_name' => $menu_name]);
    }

    function update_role(Request $request, $id)
    {
        User::where('id', $id)->update([
            'role_id' => $request->role_id
        ]);

        Session::flash('message', 'User / Employee Successfully Update Roles');

        return redirect()->route('user');
    }
}
