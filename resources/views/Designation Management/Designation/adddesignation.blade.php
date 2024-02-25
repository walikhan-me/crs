@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Desination Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Designation</a></li>
      <li class="breadcrumb-item">Add Designation</li>
      
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title ">Add Desination</h3>
          <form class="row g-3" enctype="multipart/form-data"  method='POST'  action='/create_designation'>
             @csrf  
              <div class="col-8">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="department_id" name="department_id">
                             <option value="" selected>Select Department</option>
                              @if(count($departments) > 0)
                                  @foreach($departments as $department)
                                      <option value="{{ $department->department_id}}">{{ $department->department_name }}</option>
                                  @endforeach
                              @else  
                                  <option value="" disabled>No Departments found</option>
                              @endif  
                          </select>
                        <label for="floatingSelect">Department</label>
                    </div>
                    @if ($errors->has('department_name'))
                      <span style='color:red'>
                          {{ $errors->first('department_name') }}
                      </span>
                   @endif
                </div>
               
                <div class="col-8">
                  <label for="department_name" class="form-label">Add New Desination</label>
                  <input type="text" class="form-control" name="designation_name">
                  @if ($errors->has('designation_name'))
                      <span style='color:red'>
                          {{ $errors->first('designation_name') }}
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


