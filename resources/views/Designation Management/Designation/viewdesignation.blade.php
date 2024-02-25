@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>View Designations</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Designations</a></li>
      <li class="breadcrumb-item">view Designations</li>
      
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">View Designations</h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>
                  <b>S</b>no
                </th>
                <th>Designation Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(isset($view_designation) && count($view_designation) > 0)
                      @php $s_no = 1;  @endphp
                      @foreach($view_designation as $designation)
                          <tr>
                              <td>{{$s_no++}}</td>
                              <td>{{$designation->designation_name}}</td>
                              <td>{{$designation->status}}</td>
                              <td>
                                  <a href="{{ route('editdesignation', ['id' => $designation->designation_id ]) }}"><i class="bi bi-pencil "></i></a>
                                  <a href="{{ route('deletedesignation', ['id' => $designation->designation_id ]) }}" onclick="confirmDeactivation(event)">
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