<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeEducation;
use Illuminate\Support\Facades\Session;

class EmployeeEducationController extends Controller
{
    // function index(){
    //     $menu_name = 'User / Employee Education';
    //     return $menu_name;
    //     // return view('admin_dashboard.user.education.add_education', ['user_id' => $id, 'menu_name' => $menu_name]);
    // }

    function add($id){
        $menu_name = 'User / Employee Education';
        // return $menu_name;
        return view('admin_dashboard.user.education.add_education', ['user_id' => $id, 'menu_name' => $menu_name]);
    }

    function create(Request $request, $id){
        $request->validate([
            'education_level' => 'required|string|max:20',
            'major' => 'required|string|max:200',
            'graduate' => 'required|date'
        ]);

        EmployeeEducation::create([
            'user_id' => $id,
            'education_level' => $request->education_level,
            'major' => $request->major,
            'graduate' => $request->graduate,
        ]);

        Session::flash('message', 'User/Employee Education Successfully Added');

        return redirect('/user/'.$id.'/detail');
    }

    function edit($id){
        $menu_name = 'User / Employee Education';
        $edit = EmployeeEducation::findOrFail($id);
        return view('admin_dashboard.user.education.edit_education', ['edit' => $edit, 'menu_name' => $menu_name]);
    }

    function update(Request $request, $id){
        $request->validate([
            'education_level' => 'required|string|max:20',
            'major' => 'required|string|max:200',
            'graduate' => 'required|date'
        ]);

        $edit = EmployeeEducation::findOrFail($id);
        $edit->update($request->all());

        Session::flash('message', 'User/Employee Education Successfully Update');

        return redirect('/user/'.$edit->user_id.'/detail');
    }

    function delete($id){
        $delete = EmployeeEducation::findOrFail($id);
        $delete->delete();

        Session::flash('message', 'User/Employee Successfully Deleted');
        
        return redirect('/user/'.$delete->user_id.'/detail');
    }
}
