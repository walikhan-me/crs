@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>View Employees</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Employees</a></li>
      <li class="breadcrumb-item">view Employees</li>
      
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">View Employees</h5>
          <table class="table datatable">
            <thead>
              <tr>
                <th>
                  <b>S</b>no
                </th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>User name</th>
                <th>Mobile</th>
                <th>Department Name</th>
                <th>Designation Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($emplyess_data) && count($emplyess_data) > 0)
                        @php $s_no = 1;  @endphp
                        @foreach($emplyess_data as $employee)
                            <tr>
                                <td>{{$s_no++}}</td>
                                <td>{{$employee->employee_name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->user_name}}</td>
                                <td>{{$employee->mobile}}</td>
                                <td>{{$employee->department_name}}</td>
                                <td>{{$employee->designation_name}}</td>
                                <td>
                                    <a href="{{ route('editemployee', ['id' => $employee->emp_id ]) }}"><i class="bi bi-pencil"></i></a>
                                    <a href="" onclick="confirmDeactivation(event)">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p>No departments found.</p>
                    @endif
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

</main>

@endsection