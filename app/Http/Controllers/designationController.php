<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class designationController extends Controller
{
    public function adddesignation(){
        $departments = DB::table('departments')->where('status',1)->get();
        return view('/Designation Management/Designation/adddesignation', ['departments' => $departments]);
    }

    public function create_designation(Request $request){
        $validate  = $request->validate([
            'department_id' => 'required|string|max:255',
            'designation_name' => 'required|string|max:255|unique:designations',
        ],
        [
            'designation_name.unique' => 'this designation name already exist you need to check on view Designation'
        ]
    
    );

        $designation = new Designation();
        $designation->designation_name = $request->designation_name;
        $designation->department_id = $request->department_id;
        $designation->status = 1;
        $designation->save();
        return redirect()->back()->with('success', 'Designation added successfully');
    }


    public function viewdesignation(){
        $designation = Designation::where('status',1)->get();
        return view('Designation Management/Designation/viewdesignation', ['view_designation' => $designation]);
        
    }
    public function editdesignation($id){
        $designation = Designation::find($id);
        return view('Designation Management.Designation.editdesignation', ['edit_designation' => $designation]);
    }
    public function editindesignation(Request $request){
        $validatedData = $request->validate([
            'edit_designation_name' => 'required|string|max:255',
            'edit_designation_id' => 'required|integer',
        ]);
        
        $designation = Designation::find($request->edit_designation_id);

        if (!$designation) {
            return redirect()->back()->with('error', 'Designation not found');
        }
        $designation->designation_name = $request->edit_designation_name;

        $designation->status = 1;
        $designation->save();
        return redirect()->route('viewdesignation')->with('success', 'Designation updated successfully');

    }
    public function deletedesignation($id)
    {
        $department = Designation::find($id);
        if (!$department) {
            return redirect()->route('viewdepartment')->with('error', 'Designation not found');
        }
        $department->status = 0;
        $department->save();
        return redirect()->route('viewdesignation')->with('success', 'Designation set as inactive successfully');
    }
}
