@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>View Departments</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Departments</a></li>
      <li class="breadcrumb-item">view Department</li>
      
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">View Departments</h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>
                  <b>S</b>no
                </th>
                <th>Department Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($view_departments) && count($view_departments) > 0)
                    @php $s_no = 1;  @endphp
                    @foreach($view_departments as $department)
                        <tr>
                            <td>{{$s_no++}}</td>
                            <td>{{$department->department_name}}</td>
                            <td>{{$department->status}}</td>
                            <td>
                                <a href="{{ route('editdepartment', ['id' => $department->department_id]) }}"><i class="bi bi-pencil "></i></a>
                                <a href="{{ route('deleteDepartment', ['id' => $department->department_id]) }}" onclick="confirmDeactivation(event)">
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