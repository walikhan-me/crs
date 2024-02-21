<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employee_controller;
use App\Http\Controllers\departmentController;

Route::get('/', function () {
    return view('welcome');
});
// Employee Controller//
Route::get('/Employee Management/Add Employees/addemployee', [employee_controller::class, 'addemployee'])->name('addemployee');

// End Employee Controller//

// Department Controller//
Route::get('/Department Management/Departments/adddepartment', [departmentController::class, 'adddepartment'])->name('adddepartment');

// End Department Controller//