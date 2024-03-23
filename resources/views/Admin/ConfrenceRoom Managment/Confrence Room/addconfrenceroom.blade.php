@extends('welcome')


@section('content')
<main id="main" class="main">

<div class="pagetitle">
  <h1>Confrenceroom Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Confrence Room</a></li>
      <li class="breadcrumb-item">Add Confrenceroom</li>
      
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title ">Add Confrenceroom</h3>
          <form class="row g-3" enctype="multipart/form-data"  method='POST'  action='/create_confrenceroom'>
             @csrf  
                <div class="col-8">
                  <label for="confrenece_room" class="form-label">Add Confrenceroom</label>
                  <input type="text" class="form-control" name="confrenceroom" value="{{ old('confrenceroom') }}">
                  @if($errors->has('confrenceroom'))
                      <span class="text-danger">{{ $errors->first('confrenceroom') }}</span>
                  @endif
                  
                </div>
               
              
                <div class="col-12 ">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
          </form>
           
        </div>
      </div>

    </div>
  </div>

@endsection


