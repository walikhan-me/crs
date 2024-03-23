@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Employee Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Employee</a></li>
      <li class="breadcrumb-item">Edit Employee</li>
      
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title ">Edit Employee</h3>
          <form class="row g-3" enctype="multipart/form-data"  method='POST'  action='/editinemployee'>
             @csrf  
                <input type="hidden" class="form-control" name="emp_id" value="{{$editemployee->emp_id}}">
               

                <div class="col-8  ">
                  <label for="department_name" class="form-label">Edit Employee Name</label>
                  <input type="text" class="form-control" name="edit_employee_name" value="{{$editemployee->employee_name}}">
                  
                  @if ($errors->has('edit_employee_name'))
                      <span style='color:red'>
                          {{ $errors->first('edit_employee_name') }}
                      </span>
                  @endif
                </div>
               
                <div class="col-8  ">
                  <label for="department_name" class="form-label">Edit Email</label>
                  <input type="text" class="form-control" name="edit_email" value="{{$editemployee->email}}">
                  
                  @if ($errors->has('edit_email'))
                      <span style='color:red'>
                          {{ $errors->first('edit_email') }}
                      </span>
                  @endif
                </div>

                <div class="col-8  ">
                  <label for="department_name" class="form-label">Edit Username</label>
                  <input type="text" class="form-control" name="edit_username" value="{{$editemployee->user_name}}">
                  
                  @if ($errors->has('edit_username'))
                      <span style='color:red'>
                          {{ $errors->first('edit_username') }}
                      </span>
                  @endif
                </div>
                <div class="col-8  ">
                  <label for="department_name" class="form-label">Password</label>
                  <input type="text" class="form-control" name="edit_password" value="{{$editemployee->password}}">
                  
                  @if ($errors->has('edit_password'))
                      <span style='color:red'>
                          {{ $errors->first('edit_password') }}
                      </span>
                  @endif
                </div>
                <div class="col-8">
                  <label for="department_name" class="form-label">Edit Mobile</label>
                  <input type="text" class="form-control" name="edit_mobile" value="{{$editemployee->mobile}}">
                  
                  @if ($errors->has('edit_mobile'))
                      <span style='color:red'>
                          {{ $errors->first('edit_mobile') }}
                      </span>
                  @endif
                </div>
                
                <div class="col-8  ">
                  <label for="department_name" class="form-label">Edit Department</label>
                  <input type="text" class="form-control" name="edit_department_name" value="{{$editemployee->department_id}}">
                  
                  @if ($errors->has('edit_department_name'))
                      <span style='color:red'>
                          {{ $errors->first('edit_department_name') }}
                      </span>
                  @endif
                </div>

                <div class="col-8  ">
                  <label for="department_name" class="form-label">Edit Designation</label>
                  <input type="text" class="form-control" name="edit_designation_name" value="{{$editemployee->designation_id}}">
                  
                  @if ($errors->has('edit_designation_name'))
                      <span style='color:red'>
                          {{ $errors->first('edit_designation_name') }}
                      </span>
                  @endif
                </div>

              
               
              
                <div class="col-12 ">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
          </form>
          <div class="fields_success_message" style="display: none; color: green;">
              Employee updated successfully!
          </div>
           
        </div>
      </div>

    </div>
  </div>

@endsection


