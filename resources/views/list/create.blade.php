@extends('layouts.master')


@section('content')


  <h2>Create New Employee</h2><br  />
  <form method="post" action="{{url('restricted/employees')}}"> 
  	{{csrf_field()}}

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="parent_id">BOSS (optional):</label>
        <input type="text" class="form-control" name="parent_id" pattern="^\d{1,10}$">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="full_name">FULL NAME:</label>
        <input type="text" class="form-control" name="full_name" maxlength="255" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="position">POSITION:</label>
        <input type="text" class="form-control" name="position" maxlength="255" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="start_date">STARTED:</label>
        <input type="date" class="form-control" name="start_date" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <label for="salary">SALARY:</label>
        <input type="text" class="form-control" name="salary" pattern="^\d{1,5}(\.\d{2})?$" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
        <button type="submit" class="btn btn-success">Add Employee</button>
      </div>
    </div>

    @include ('layouts.errors')

  </form>




@endsection