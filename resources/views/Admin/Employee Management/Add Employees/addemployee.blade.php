
@extends('welcome')
@section('styles')


@endsection
<main id="main" class="main">

<div class="pagetitle">
  <h1>Employee Managment</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Employee Managment</a></li>
      <li class="breadcrumb-item">Add Employee</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
    

    <div class="col-lg-12">

      

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Employee</h5>

          <form class="row g-3" enctype="multipart/form-data"  method='POST'  action='/create_employee'>
             @csrf  
                <div class="col-8 ">
                  <label for="department_name" class="form-label">Employee Name</label>
                  <input type="text" class="form-control" name="employee_name">
                  @if ($errors->has('employee_name'))
                      <span style='color:red'>
                          {{ $errors->first('employee_name') }}
                      </span>
                  @endif
                </div>

                <div class="col-8 ">
                  <label for="user_name" class="form-label">User Name</label>
                  <input type="text" class="form-control" name="user_name">
                  @if ($errors->has('user_name'))
                      <span style='color:red'>
                          {{ $errors->first('user_name') }}
                      </span>
                  @endif
                </div>

                <div class="col-8">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password">
                  @if ($errors->has('user_name'))
                      <span style='color:red'>
                          {{ $errors->first('user_name') }}
                      </span>
                  @endif
                </div>
                <div class="col-8">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email">
                  @if ($errors->has('email'))
                      <span style='color:red'>
                          {{ $errors->first('email') }}
                      </span>
                  @endif
                </div>
                <div class="col-8">
                  <label for="mobile" class="form-label">Mobile</label>
                  <input type="number" class="form-control" name="mobile">
                  @if ($errors->has('mobile'))
                      <span style='color:red'>
                          {{ $errors->first('mobile') }}
                      </span>
                  @endif
                </div>

                <div class="form-floating mb-3 col-8">
                    <select class="form-select" id="department_name" name="department_name" onchange="getDesignations()">
                        <option value="" selected>Select Department</option>
                        @if(count($emp_detail) > 0)
                            @foreach($emp_detail as $emp)
                                <option value="{{ $emp->department_id }}">{{ $emp->department_name }}</option>
                            @endforeach
                        @else  
                            <option value="" disabled>No Departments found</option>
                        @endif  
                    </select>
                    <label for="floatingSelect">Department</label>
                </div>

                <div class="form-floating mb-3 col-8">
                    <select class="form-select" name="designation_name" id="designation_name">
                        <option value="" selected>Select Designation</option>
                    </select>
                    <label for="floatingSelect">Designation</label>
                </div>
               
              
                <div class="col-12 ">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
          </form>

        
       
        </div>
      </div>

    </div>
  </div>
  <script>
    function getDesignations() {
        var departmentId = document.getElementById('department_name').value;
         
        if (departmentId !== "") {
            fetch('/get-designations/' + departmentId)
                .then(response => response.json())
                .then(data => {
                    var designationSelect = document.getElementById('designation_name');
                    designationSelect.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(designation => {
                            var option = document.createElement('option');
                            option.value = designation.designation_id;
                            option.text = designation.designation_name;
                            designationSelect.add(option);
                        });
                    } else {
                        var option = document.createElement('option');
                        option.value = "";
                        option.text = "No Designations found";
                        designationSelect.add(option);
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            var designationSelect = document.getElementById('designation_name');
            designationSelect.innerHTML = "";
            var defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.text = "Select Designation";
            designationSelect.add(defaultOption);
            designationSelect.disabled = true;
        }
    }
</script>


@section('content')
@endsection()