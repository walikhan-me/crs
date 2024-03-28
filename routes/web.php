<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\employee_controller;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\designationController;
use App\Http\Controllers\confrenceroomController;
use App\Http\Controllers\confrenec_room_report_controller;
use App\Http\Controllers\adminloginController;
use App\Http\Controllers\Auth\LoginController;
// Route::get('/',[employee_controller::class,'welcome']);


Route::middleware('web')->group(function () {

  

    // Route::post('/logout',[Auth\LoginController::class, 'logout'] )->name('logout');
});




Route::get('/welcome', [employee_controller::class, 'welcome'])->name('welcome');
// Employee Controller//
Route::get('/get-designations/{department_id}', [employee_controller::class, 'getDesignations']);
Route::get('Admin/Employee Management/Add Employees/addemployee', [employee_controller::class, 'addemployee'])->name('addemployee');
Route::post('/create_employee', [employee_controller::class, 'create_employee'])->name('create_employee');
Route::get('Admin/Employee Management/Add Employees/viewemployee', [employee_controller::class, 'viewemployee'])->name('viewemployee');
Route::get('Admin/Employee Management/Add Employees/editemployee/{id}', [employee_controller::class, 'editemployee'])->name('editemployee');
Route::post('/editinemployee', [employee_controller::class, 'editinemployee'])->name('editinemployee');

Route::get('/deleteemployee/{id}', [employee_controller::class, 'deleteemployee'])->name('deleteemployee');

// End Employee Controller//

// Department Controller//


Route::post('/create_department', [departmentController::class, 'create_department'])->name('create_department');

Route::get('Admin/Department Management/Departments/editdepartment/{id}', [DepartmentController::class, 'editdepartment'])->name('editdepartment');
Route::post('/editindepartment', [departmentController::class, 'editindepartment'])->name('editindepartment');
Route::get('/deleteDepartment/{id}', [departmentController::class, 'deleteDepartment'])->name('deleteDepartment');


// new department
Route::get('Admin/Department Management/Departments/viewdepartment', [DepartmentController::class, 'viewdepartment'])->name('viewdepartment');
Route::get('Admin/Department Management/Departments/adddepartment', [departmentController::class, 'adddepartment'])->name('adddepartment');
//end  new department




// End Department Controller//

// Designation Controller//
Route::get('Admin/Designation Management/Designation/adddesignation', [designationController::class, 'adddesignation'])->name('adddesignation');
Route::post('/create_designation', [designationController::class, 'create_designation'])->name('create_designation');
Route::get('Admin/Designation Management/Designation/viewdesignation', [designationController::class, 'viewdesignation'])->name('viewdesignation');
Route::get('Admin/Designation Management/Designation/editdesignation/{id}', [designationController::class, 'editdesignation'])->name('editdesignation');
Route::post('/editindesignation', [designationController::class, 'editindesignation'])->name('editindesignation');
Route::get('/deletedesignation/{id}', [designationController::class, 'deletedesignation'])->name('deletedesignation');
// End Designation Controller//

//confrenece room 

Route::get('Admin/ConfrenceRoom Managment/Confrence Room/addconfrenceroom', [confrenceroomController::class, 'addconfrenceroom'])->name('addconfrenceroom');
Route::post('/create_confrenceroom', [confrenceroomController::class, 'create_confrenceroom'])->name('create_confrenceroom');
Route::get('ConfrenceRoom Managment/Confrence Room/bookconfrenceroom', [confrenceroomController::class, 'bookconfrenceroom'])->name('bookconfrenceroom');
Route::get('Admin/ConfrenceRoom Managment/Confrence Room/viewconfrenceroom', [confrenceroomController::class, 'viewconfrenceroom'])->name('viewconfrenceroom');
Route::get('Admin/ConfrenceRoom Managment/Confrence Room/editconfrenceroom/{id}', [confrenceroomController::class, 'editconfrenceroom'])->name('editconfrenceroom');
Route::post('/editinconfrenceroom', [confrenceroomController::class, 'editinconfrenceroom'])->name('editinconfrenceroom');
Route::get('/deleteconfrenceroom/{id}', [confrenceroomController::class, 'deleteconfrenceroom'])->name('deleteconfrenceroom');

Route::get('Admin/ConfrenceRoom Managment/Booked Confrence Room/bookedconfreneceroom', [confrenceroomController::class, 'bookedconfreneceroom'])->name('bookedconfreneceroom');
Route::get('/employee/search', [confrenceroomController::class, 'searchEmployees'])->name('employee.search');
Route::post('/create_bookedconfrenceroom', [confrenceroomController::class, 'create_bookedconfrenceroom'])->name('create_bookedconfrenceroom');
Route::get('Admin/ConfrenceRoom Managment/Booked Confrence Room/viewbookedconfrenceroom', [confrenceroomController::class, 'viewbookedconfrenceroom'])->name('viewbookedconfrenceroom');

Route::get('ConfrenceRoom Managment/Booked Confrence Room/editbookedconfrenceroom/{id}', [confrenceroomController::class, 'editbookedconfrenceroom'])->name('editbookedconfrenceroom');
Route::get('/cancelmeeting/{id}', [confrenceroomController::class, 'cancelmeeting'])->name('cancelmeeting');
//end confrenece room

//confrenece room report controller

Route::get('Admin/Generate Reports/Confrence Room Report/booked_room_report', [confrenec_room_report_controller::class, 'booked_room_report'])->name('booked_room_report');
Route::get('generate-conference-room-report', [confrenec_room_report_controller::class, 'confrenceRoomReport'])->name('generate-conference-room-report');
Route::get('Admin/Generate Reports/Confrence Room Report/conference_room_report', [confrenec_room_report_controller::class, 'conference_room_report'])->name('conference_room_report');


//admin login route
Route::get('Admin/login', [adminloginController::class, 'login'])->name('login');
Route::post('/admin_Login', [adminloginController::class, 'admin_Login'])->name('admin_Login');

Route::get('Admin/registration', [adminloginController::class, 'registration'])->name('registration');
Route::post('/admin_registration', [adminloginController::class, 'admin_registration'])->name('admin_registration');
