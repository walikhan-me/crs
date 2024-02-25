@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Designation Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Designation</a></li>
      <li class="breadcrumb-item">Edit Designation</li>
      
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title ">Add Designation</h3>
          <form class="row g-3" enctype="multipart/form-data"  method='POST'  action='/editindesignation'>
             @csrf  
                <input type="hidden" class="form-control" name="edit_designation_id" value="{{$edit_designation->designation_id }}">
               

                <div class="col-8  ">
                  <label for="department_name" class="form-label">Edit Designation</label>
                  <input type="text" class="form-control" name="edit_designation_name" value="{{$edit_designation->designation_name}}">
                  
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
          <div class="fields_success_message" style="display: none; color: green;">
              Department updated successfully!
          </div>
           
        </div>
      </div>

    </div>
  </div>

@endsection


