@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>View Confrence Room</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Confrence Room</a></li>
      <li class="breadcrumb-item">view Confrence Room</li>
      
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">View Confrence Room</h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>
                  <b>S</b>no
                </th>
                <th>Confrence Room</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($confrenceroom_view) && count($confrenceroom_view) > 0)
                        @php $s_no = 1;  @endphp
                        @foreach($confrenceroom_view as $confrence_room)
                            <tr>
                                <td>{{$s_no++}}</td>
                                <td>{{$confrence_room->confrence_room}}</td>
                                <td>{{$confrence_room->status}}</td>
                                <td>
                                <a href="{{ route('editconfrenceroom', ['id' => $confrence_room->confrenceroom_id]) }}"><i class="bi bi-pencil "></i></a>
                                <a href="{{ route('deleteconfrenceroom', ['id' => $confrence_room->confrenceroom_id]) }}" onclick="confirmDeactivation(event)"><i class="bi bi-trash "></i></a>  

                                </td>
                            </tr>
                        @endforeach
                @else
                    <p>No Confrence Room found.</p>
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