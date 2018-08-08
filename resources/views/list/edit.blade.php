@extends('layouts.master')


@section('content')

	@if (\Session::has('error'))
      <div class="alert alert-danger mt-3">
          <p>{{ \Session::get('error') }}</p>
      </div><br />
  @endif

  <h2>Update Employee</h2><br  />
  <form method="post" action="{{action('EmployeeController@update', $id)}}" enctype="multipart/form-data"> 
  	{{csrf_field()}}
    <input name="_method" type="hidden" value="PATCH">

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="parent_id">BOSS (optional):</label>
        <input type="text" class="form-control" name="parent_id" value="{{$employee->parent_id}}" pattern="^\d{1,10}$">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="full_name">FULL NAME:</label>
        <input type="text" class="form-control" name="full_name" value="{{$employee->full_name}}" maxlength="255" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="position">POSITION:</label>
        <input type="text" class="form-control" name="position" value="{{$employee->position}}" maxlength="255" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="start_date">STARTED:</label>
        <input type="date" class="form-control" name="start_date" value="{{$employee->start_date}}" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="salary">SALARY:</label>
        <input type="text" class="form-control" name="salary" value="{{$employee->salary}}" pattern="^\d{1,5}(\.\d{2})?$" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
        <div class="form-group col-md-4">
          <img src="{{((intval($employee->has_photo) == 1) ? asset('photos/'.$employee->id.'.jpg') : asset('photos/no-photo.jpg'))}}" style="max-height:300px">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="photo">PHOTO (optional, only .jpeg):</label>
        <input type="file" class="form-control" name="photo">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <button type="submit" class="btn btn-success">Update Employee</button>
      </div>
    </div>

    @include ('layouts.errors')

  </form>




@endsection