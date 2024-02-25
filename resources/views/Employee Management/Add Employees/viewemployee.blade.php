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
             
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

</main>

@endsection