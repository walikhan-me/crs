@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Confrenceroom Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Confrenceroom</a></li>
      <li class="breadcrumb-item">Edit Confrenceroom</li>
      
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title ">Edit Confrenceroom</h3>
          <form class="row g-3" enctype="multipart/form-data"  method='POST'  action='/editinconfrenceroom'>
             @csrf  
                <div class="col-8  ">
                  <label for="department_name" class="form-label">Edit Department</label>
                  <input type="hidden" class="form-control" name="edit_confrence_room_id" value="{{$edit_confrenceroom->confrenceroom_id}}">
                  <input type="text" class="form-control" name="edit_confrence_room_name" value="{{$edit_confrenceroom->confrence_room}}">
                  @if ($errors->has('edit_confrence_room_name'))
                      <span style='color:red'>
                          {{ $errors->first('edit_confrence_room_name') }}
                      </span>
                  @endif
                </div>

                <div class="col-12 ">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
          </form>
          <div class="fields_success_message" style="display: none; color: green;">
               Confrenceroom updated successfully!
          </div>
           
        </div>
      </div>

    </div>
  </div>

@endsection


