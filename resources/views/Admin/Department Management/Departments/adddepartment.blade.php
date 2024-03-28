@extends('welcome')

@section('content')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Department Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Departments</a></li>
      <li class="breadcrumb-item">Add Department</li>
      
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title ">Add Department</h3>
          <form class="row g-3" enctype="multipart/form-data"  method='POST'  action='/create_department'>
             @csrf  
                <div class="col-8   ">
                  <label for="department_name" class="form-label">Add New Department</label>
                  <input type="text" class="form-control" name="department_name">
                  @if ($errors->has('department_name'))
                      <span style='color:red'>
                          {{ $errors->first('department_name') }}
                      </span>
                  @endif
                </div>
               
              
                <div class="col-12 ">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
          </form>
           
        </div>
      </div>

    </div>
  </div>

  @endsection


