<?php

namespace App\Http\Controllers;

use App\Models\LeaveBalance;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class LeaveBalanceController extends Controller
{
    function create(Request $request, $id){

        Gate::authorize('create', LeaveBalance::class);

        $request->validate([
            'year' => 'required|digits:4|integer|min:2020|max:' . (date('Y') + 1),
            'remaining_leave' => 'required|numeric',
        ]);

        $overlap = LeaveBalance::where(['user_id' => $request->user_id, 'year' => $request->year])->exists();
        if($overlap){
            return back()->withErrors(['year' => 'Tahun Cuti Sudah ada.']);
        }

        LeaveBalance::create($request->all());

        Session::flash('message', 'Amount of Leave Successfully Added');

        return redirect('/user/'.$id.'/detail');
    }

    function update(Request $request, $id){
        $request->validate([
            'year' => 'required|digits:4|integer|min:2020|max:' . (date('Y') + 1),
            'remaining_leave' => 'required|numeric',
        ]);

        $edit = LeaveBalance::findOrFail($id);
        $edit->update($request->all());

        Session::flash('message', 'Amount of Leave Successfully Update');

        return redirect('/user/'.$edit->user_id.'/detail');
    }

    function delete($id){
        $delete = LeaveBalance::findOrFail($id);
        $delete->delete();

        Session::flash('message', 'Amount of Leave Successfully Deleted');
        
        return redirect('/user/'.$delete->user_id.'/detail');
    }
}
