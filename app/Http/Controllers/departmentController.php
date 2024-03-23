<?php

namespace App\Http\Controllers;
use App\Models\Department;

use Illuminate\Http\Request;

class departmentController extends Controller
{
    
    public function adddepartment(){
        return view('Admin/Department Management/Departments/adddepartment');
    }

    public function create_department(Request $request){
        $validatedData = $request->validate([
            'department_name' => 'required|string|max:255',
        ]);
       $department = new Department();
       $department->department_name = $request->department_name;
       $department->status = 1;
       $department->save();
       return redirect()->back()->with('success', 'Department added successfully');

    }

    public function viewdepartment(){
        $departments = Department::where('status',1)->get();
        return view('Admin/Department Management.Departments.viewdepartment', ['view_departments' => $departments]);
    }
    public function editdepartment($id){
        $department = Department::find($id);
        return view('Admin/Department Management.Departments.editdepartment', ['edit_department' => $department]);
    }
    public function editindepartment(Request $request){
        $validatedData = $request->validate([
            'edit_department_name' => 'required|string|max:255',
            'edit_department_id' => 'required|integer',
        ]);
        
        $department = Department::find($request->edit_department_id);

        if (!$department) {
            return redirect()->back()->with('error', 'Department not found');
        }
        $department->department_name = $request->edit_department_name;
       
        $department->status = 1;
        $department->save();
        return redirect()->route('viewdepartment')->with('success', 'Department updated successfully');

    }
    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        if (!$department) {
            return redirect()->route('viewdepartment')->with('error', 'Department not found');
        }
        $department->status = 0;
        $department->save();
        return redirect()->route('viewdepartment')->with('success', 'Department set as inactive successfully');
    }
}
