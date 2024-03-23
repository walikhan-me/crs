<div class="row">
          @foreach($upcomingMeetings as $row)
          <div class="card">
          <div class="card-header border-bottom font-weight-bold">List Of Booked Room</div>
          <div class="card-body">
              <h5 class="card-title border-bottom pb-2">Conference Room: {{ $row->conference_room }}</h5>
              <p class="card-text border-bottom pb-2"><strong>Meeting Organizer:</strong> {{ $row->username }}</p>
              <p class="card-text border-bottom pb-2"><strong>Start Date:</strong> {{ $row->start_date }}</p>
              <p class="card-text border-bottom pb-2"><strong>End Date:</strong> {{ $row->end_date }}</p>
              <p class="card-text border-bottom pb-2"><strong>Start Time:</strong> {{ $row->start_time }}</p>
              <p class="card-text border-bottom pb-2"><strong>End Time:</strong> {{ $row->end_time }}</p>
              <p class="card-text"><strong>Participant Names:</strong>
                  @php
                      $participantNamesArray = json_decode($row->participant_names);
                      if ($participantNamesArray !== null) {
                          $uniqueNames = implode(', ', array_map('trim', $participantNamesArray));
                          echo $uniqueNames;
                      }
                  @endphp
              </p>
          </div>
          <div class="card-footer border-top font-weight-bold">
              EOBI Soft
          </div>
      </div>

        
          @endforeach
      </div>
