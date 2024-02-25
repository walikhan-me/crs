<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employee_controller;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\designationController;

Route::get('/', function () {
    return view('welcome');
});
// Employee Controller//
Route::get('/get-designations/{department_id}', [employee_controller::class, 'getDesignations']);
Route::get('/Employee Management/Add Employees/addemployee', [employee_controller::class, 'addemployee'])->name('addemployee');
Route::post('/create_employee', [employee_controller::class, 'create_employee'])->name('create_employee');
Route::get('/Employee Management/Add Employees/viewemployee', [employee_controller::class, 'viewemployee']);
Route::get('/Employee Management/Add Employees/editemployee/{id}', [employee_controller::class, 'editemployee'])->name('editemployee');
// End Employee Controller//

// Department Controller//

Route::get('/Department Management/Departments/adddepartment', [departmentController::class, 'adddepartment'])->name('adddepartment');
Route::post('/create_department', [departmentController::class, 'create_department'])->name('create_department');
Route::get('/Department Management/Departments/viewdepartment', [DepartmentController::class, 'viewdepartment'])->name('viewdepartment');
Route::get('/Department Management/Departments/editdepartment/{id}', [DepartmentController::class, 'editdepartment'])->name('editdepartment');
Route::post('/editindepartment', [departmentController::class, 'editindepartment'])->name('editindepartment');
Route::get('/deleteDepartment/{id}', [departmentController::class, 'deleteDepartment'])->name('deleteDepartment');
// End Department Controller//

// Designation Controller//
Route::get('/Designation Management/Designation/adddesignation', [designationController::class, 'adddesignation'])->name('adddesignation');
Route::post('/create_designation', [designationController::class, 'create_designation'])->name('create_designation');
Route::get('/Designation Management/Designation/viewdesignation', [designationController::class, 'viewdesignation'])->name('viewdesignation');
Route::get('/Designation Management/Designation/editdesignation/{id}', [designationController::class, 'editdesignation'])->name('editdesignation');
Route::post('/editindesignation', [designationController::class, 'editindesignation'])->name('editindesignation');
Route::get('/deletedesignation/{id}', [designationController::class, 'deletedesignation'])->name('deletedesignation');
// End Designation Controller//

