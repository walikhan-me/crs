@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Generate Reports</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Confrence Room Report</a></li>
      <!-- <li class="breadcrumb-item">Add Department</li> -->
      
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title ">Booked Confrenece Room Report</h3>
          <form class="row g-3" enctype="multipart/form-data"  method='GET'  action='/generate-conference-room-report'>
             @csrf  
                <div class="col-8   ">
                  <label for="start_date" class="form-label">Start Date</label>
                  <input type="date" class="form-control" name="start_date">
                  @if ($errors->has('start_date'))
                      <span style='color:red'>
                          {{ $errors->first('start_date') }}
                      </span>
                  @endif
                </div>
                <div class="col-8   ">
                  <label for="end_date" class="form-label">End Date</label>
                  <input type="date" class="form-control" name="end_date">
                  @if ($errors->has('end_date'))
                      <span style='color:red'>
                          {{ $errors->first('end_date') }}
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


