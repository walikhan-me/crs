@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Confrenceroom Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Booked Confrence Room</a></li>
      <li class="breadcrumb-item">Booked Confrenceroom</li>
      
    </ol>
  </nav>
</div>
<section class="section">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Booked Confrence Room</h3>
                <div class="col-8">
                    <label for="employee_search" class="form-label">Search Meeting Participant</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="employee_search" name="query" placeholder="Enter search query">
                        <button class="btn btn-outline-secondary" type="button" onclick="searchEmployees()">Search</button>
                    </div>
                </div>

                  
                <form id="participants-form" class="row g-3" enctype="multipart/form-data" method="POST" action="/create_bookedconfrenceroom">
                    @csrf
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="col-8">
                        <label for="conference_room" class="form-label">Meeting Participants</label>
                        <ul id="employee_results"></ul>
                        <ul id="selected_participants"></ul>
                        <input type="hidden" id="selected_employee_id" name="selected_employee_ids[]">
                       <input type="hidden" id="selected_employee_name" name="selected_employee_names[]">
                       <input type="hidden" id="selected_employee_email" name="selected_employee_emails[]">                   
                    </div>

                    <div class="col-8">
                        <label for="confrenece_room" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" value="">
                        @if($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <div class="col-8">
                        <label for="confrenece_room" class="form-label">User Id</label>
                        <input type="text" class="form-control" name="user_id" value="">
                        @if($errors->has('user_id'))
                            <span class="text-danger">{{ $errors->first('user_id') }}</span>
                        @endif
                    </div>

                    <div class="col-8">
                        <label for="confrenece_room" class="form-label">User Email</label>
                        <input type="text" class="form-control" name="user_email" value="">
                        @if($errors->has('user_email'))
                            <span class="text-danger">{{ $errors->first('user_email') }}</span>
                        @endif
                    </div>
                    <div class="form-floating mb-3 col-8">
                    <select class="form-select" id="conference_room" name="conference_room">
                        <option value="" selected>Select Conference Room</option>
                        @foreach ($conferenceRooms as $room)
                            <option value="{{ $room->confrenceroom_id  }}">{{ $room->confrence_room }}</option>
                        @endforeach
                    </select>
                        <label for="floatingSelect">Conference Room</label>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <label for="confrenece_room" class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date" value="">
                            @if($errors->has('start_date'))
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>

                        <div class="col-4">
                            <label for="confrenece_room" class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="">
                            @if($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-4">
                          <label for="confrenece_room" class="form-label">Start Time</label>
                          <input type="time" class="form-control" name="start_time" value="">
                          @if($errors->has('start_time'))
                              <span class="text-danger">{{ $errors->first('start_time') }}</span>
                          @endif
                      </div>

                      <div class="col-4">
                          <label for="confrenece_room" class="form-label">End Time</label>
                          <input type="time" class="form-control" name="end_time" value="">
                          @if($errors->has('end_time'))
                              <span class="text-danger">{{ $errors->first('end_time') }}</span>
                          @endif
                      </div>
                    </div>
                    
                    

                    

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
          

<script>
    var selectedParticipants = new Set();

    function searchEmployees() {
        var query = document.getElementById('employee_search').value;
        if (query.trim() === '') {
            alert('Please enter a search query.');
            return;
        }
        // Example using fetch API
        fetch('/employee/search?query=' + query)
            .then(response => response.json())
            .then(data => {
                var resultsContainer = document.getElementById('employee_results');
                var participantsList = document.getElementById('selected_participants');

                data.employees.forEach(employee => {
                    var listItem = document.createElement('div');
                    listItem.textContent = 'Participant: ' + employee.employee_name;
                    listItem.addEventListener('click', function () {
                        
                        if (!selectedParticipants.has(employee.email)) {
                          
                            document.getElementById('selected_employee_id').value = employee.emp_id;
                            document.getElementById('selected_employee_name').value = employee.employee_name;
                            document.getElementById('selected_employee_email').value = employee.email;
                            
                            var hiddenInputId = document.createElement('input');
                            hiddenInputId.type = 'hidden';
                            hiddenInputId.name = 'selected_employee_ids[]';
                            hiddenInputId.value = employee.email; // Correct attribute name
                            document.getElementById('participants-form').appendChild(hiddenInputId);

                            var hiddenInputName = document.createElement('input');
                            hiddenInputName.type = 'text';
                            hiddenInputName.name = 'selected_employee_names[]';
                            hiddenInputName.value = employee.employee_name;
                            document.getElementById('participants-form').appendChild(hiddenInputName);

                            var participantItem = document.createElement('li');
                            participantItem.textContent = 'Selected For Meeting: ' + employee.employee_name;
                            participantsList.appendChild(participantItem);

                            selectedParticipants.add(employee.email);
                        } else {
                            alert('Participant already selected!');
                        }
                    });

                    resultsContainer.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // ... (the rest of your JavaScript code)

    function isEmployeeSelected(email) {
        var query = document.getElementById('employee_search').value;
        

        if (query.trim() === '') {
            alert('Please enter a search query.');
            return;
        }
        var selectedParticipantEmails = document.getElementsByName('participant_emails[]');
        for (var i = 0; i < selectedParticipantEmails.length; i++) {
            if (selectedParticipantEmails[i].value === email) {
                return true;
            }
        }
        return false;
    }
</script>


<style>
    #employee_results {
        list-style: none;
        padding: 0;
    }

    #employee_results div {
        cursor: pointer;
        padding: 8px;
        border: 1px solid #ddd;
        margin-bottom: 5px;
        background-color: #f9f9f9;
    }

    #employee_results div:hover {
        background-color: #e0e0e0;
    }

    #selected_participants {
        list-style: none;
        padding: 0;
    }

    #selected_participants li {
        cursor: pointer;
        padding: 8px;
        border: 1px solid #007bff;
        color: #007bff;
        margin-bottom: 5px;
        background-color: #fff;
    }

    #selected_participants li:hover {
        background-color: #007bff;
        color: #fff;
    }
</style>

@endsection


