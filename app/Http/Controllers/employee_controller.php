<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class employee_controller extends Controller
{
   
    public function addemployee()
    {
        $emp_detail = DB::table('departments')
            ->join('designations', 'departments.department_id', '=', 'designations.department_id')
            ->select('designations.designation_name','designations.designation_id', 'departments.department_name', 'departments.department_id')
            ->where('departments.status', 1)
            ->get();

        return view('Employee Management/Add Employees/addemployee',['emp_detail'=>$emp_detail ]);
    }
    public function getDesignations($departmentId)
    {
        $designations = DB::table('designations')
            ->where('department_id', $departmentId)
            ->get();
    
        return response()->json($designations);
    }
    public function create_employee(Request $request){
        $validate  = $request->validate([
            'employee_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255', 
            'mobile' => [
                'required',
                'regex:/^(03[0-9]{2})[-]*[0-9]{7}$/',
                'max:11', 
            ],
            'designation_name' => 'required|string|max:255',
            'department_name' => 'required|string|max:255',
        ]
    
    );

        $employee = new Employee();
        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->user_name = $request->user_name;
        $employee->password = $request->password;
        $employee->mobile = $request->mobile;
        $employee->department_id = $request->department_name;
        $employee->designation_id = $request->designation_name;
        $employee->status = 1;
        $employee->save();
        return redirect()->back()->with('success', 'Employee added successfully');

    }

    public function viewemployee(){
        $employess =  DB::table('employees')
        ->join('designations','employees.designation_id', '=', 'designations.designation_id')
        ->join('departments','employees.department_id', '=', 'departments.department_id')
        ->select('designations.designation_name', 'departments.department_name', 'employees.employee_name', 'employees.email', 'employees.user_name', 'employees.mobile','employees.emp_id')
        ->where('employees.status',1)
        ->get();
        return view('/Employee Management/Add Employees/viewemployee',['emplyess_data' =>$employess]);
    }
    public function editemployee($id){

        $Employee = Employee::where('emp_id', $id)->first();
        return view('Employee Management.Add Employees.editemployee', ['editemployee' => $Employee]);
    }
}
