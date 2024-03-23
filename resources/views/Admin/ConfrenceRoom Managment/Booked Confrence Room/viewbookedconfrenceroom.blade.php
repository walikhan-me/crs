@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>View Confrence Room</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">View Booked Confrence Room</a></li>
      <li class="breadcrumb-item">Booked Confrence Room</li>
      
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">View Booked Confrence Room</h5>

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th>
                  <b>S</b>no
                </th>
                <th>Confrence Room</th>
                <th>Meeting Orgainizer</th>
                <th>Orgainizer Email</th>
                <th>Confrence Room</th>
                <th>Participant Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @if(isset($bookedconfrenceroom) && count($bookedconfrenceroom) > 0)
                        @php $s_no = 1;  @endphp
                        @foreach($bookedconfrenceroom as $viewconfrence_room)
                            <tr>
                                <td>{{$s_no++}}</td>
                                <td>{{$viewconfrence_room->conference_room}}</td>
                                <td>{{$viewconfrence_room->username}}</td>
                                <td>{{$viewconfrence_room->user_email}}</td>
                                
                                <td>{{$viewconfrence_room->conference_room}}</td>
                                <td>
                                    @php
                                        $participantNamesArray = json_decode($viewconfrence_room->participant_names);
                                        if ($participantNamesArray !== null) {
                                            $uniqueNames = implode(',', array_map('trim', $participantNamesArray));
                                            echo $uniqueNames;
                                        }
                                    @endphp
                                </td>
                                <td>{{$viewconfrence_room->start_time}}</td>
                                <td>{{$viewconfrence_room->end_time}}</td>
                                <td>{{$viewconfrence_room->start_date}}</td>
                                <td>{{$viewconfrence_room->end_date}}</td>
                                
                                 <td>
                                 <!-- {{ route('editbookedconfrenceroom', ['id' => $viewconfrence_room->booked_confrence_room_id]) }} -->
                               
                                <a href="{{ route('cancelmeeting', ['id' => $viewconfrence_room->booked_confrence_room_id]) }}" onclick="confirmDeactivation(event)"><i class="bi bi-trash "></i></a>  

                                </td>
                            </tr>
                        @endforeach
                @else
                    <p>No Confrence Room Booked at that time.</p>
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