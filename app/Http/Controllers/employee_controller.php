<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Models\bookedconfrenceroom;
use Illuminate\Http\Request;
use Carbon\Carbon;
class employee_controller extends Controller
{

    // public function welcome(){
    //     $currentDate = date('Y-m-d'); // Get current date in 'Y-m-d' format
    //     $currentTime = date('H:i:s'); // Get current time in 'H:i:s' format
        
    //     // Debug: Print current date and time
    //     echo "Current Date: $currentDate, Current Time: $currentTime<br>";
        
    //     $data = DB::table('bookedconfrencerooms')
    //         ->where('end_date', '>', $currentDate)
    //         ->orWhere(function ($query) use ($currentDate, $currentTime) {
    //             $query->where('end_date', '=', $currentDate)
    //                 ->where('end_time', '>', $currentTime);
    //         })
    //         ->where('status', 1)
    //         ->get();
        
    //     // Check if there are any upcoming meetings
    //     if ($data->isEmpty()) {
    //         $message = "No meetings scheduled yet.";
    //         return view('welcome', ['message' => $message]);
    //     }
        
    //     return view('welcome', ['upcomingMeetings' => $data]);
        
        
    // }
   
    public function addemployee()
    {
        $emp_detail = DB::table('departments')
            ->join('designations', 'departments.department_id', '=', 'designations.department_id')
            ->select('designations.designation_name','designations.designation_id', 'departments.department_name', 'departments.department_id')
            ->where('departments.status', 1)
            ->get();

        return view('Admin/Employee Management/Add Employees/addemployee',['emp_detail'=>$emp_detail ]);
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
        return view('Admin/Employee Management/Add Employees/viewemployee',['emplyess_data' =>$employess]);
    }
    public function editemployee($id){
       
        $Employee = Employee::where('emp_id', $id)->first();
        return view('Admin/Employee Management.Add Employees.editemployee', ['editemployee' => $Employee]);
    }
    public function editinemployee(Request $request){
        
        $validatedData = $request->validate([
            'emp_id' => 'required|integer',
            'edit_employee_name' => 'required|string|max:255',
            'edit_email' => 'required|string|max:255',
            'edit_username' => 'required|string|max:255',
            'edit_password' => 'required|string|max:255',
            'edit_mobile' => 'required|string|max:255',
            'edit_department_name' => 'required|integer',
            'edit_designation_name' => 'required|integer',
           
        ]);
      
        $Employee = Employee::find($request->emp_id);

        if (!$Employee) {
            return redirect()->back()->with('error', 'Employee not found');
        }
        $Employee->employee_name = $request->edit_employee_name;
        $Employee->email = $request->edit_email;
        $Employee->user_name = $request->edit_username;
        $Employee->password = $request->edit_password;
        $Employee->mobile = $request->edit_mobile;
        $Employee->department_id = $request->edit_department_name;
        $Employee->designation_id = $request->edit_designation_name;

        $Employee->status = 1;
        $Employee->save();
        return redirect()->route('viewemployee')->with('success', 'Employee updated successfully');
    }

    public function deleteemployee($id)
    { 
       
        $Employee = Employee::find($id);
        if (!$Employee) {
            return redirect()->route('viewemployee')->with('error', 'Employee not found');
        }
        $Employee->status = 0;
        $Employee->save();
        return redirect()->route('viewemployee')->with('success', 'Employee set as inactive successfully');
    }
    
}
