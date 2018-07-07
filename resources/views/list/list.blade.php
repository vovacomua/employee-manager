@extends('layouts.master')


@section('content')
	
	@include ('layouts.errors')

	<table class="table table-striped">

	  <thead>
	    <tr>

	      <th scope="col">ID  	<a href="{{ route('order', ['field' => 'id', 'order' => 'asc']) }}"><i class="fa fa-arrow-circle-up"></i></a>
	      						<a href="{{ route('order', ['field' => 'id', 'order' => 'desc']) }}"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search" method="GET" action="{{ route('search') }}">
	      		<input type="hidden" name="search_field" value="id">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="1" maxlength="5" pattern="\d*" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">BOSS ID   <a href="{{ route('order', ['field' => 'parent_id', 'order' => 'asc']) }}"><i class="fa fa-arrow-circle-up"></i></a>
	      							<a href="{{ route('order', ['field' => 'parent_id', 'order' => 'desc']) }}"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search" method="GET" action="{{ route('search') }}">
	      		<input type="hidden" name="search_field" value="parent_id">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="1" maxlength="5" pattern="\d*" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">FULL NAME  <a href="{{ route('order', ['field' => 'full_name', 'order' => 'asc']) }}"><i class="fa fa-arrow-circle-up"></i></a>
									 <a href="{{ route('order', ['field' => 'full_name', 'order' => 'desc']) }}"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search" method="GET" action="{{ route('search') }}">
	      		<input type="hidden" name="search_field" value="full_name">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="John Doe" maxlength="255" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">POSITION  <a href="{{ route('order', ['field' => 'position', 'order' => 'asc']) }}"><i class="fa fa-arrow-circle-up"></i></a>
	      							<a href="{{ route('order', ['field' => 'position', 'order' => 'desc']) }}"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search" method="GET" action="{{ route('search') }}">
	      		<input type="hidden" name="search_field" value="position">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="Worker" maxlength="255" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">STARTED  <a href="{{ route('order', ['field' => 'start_date', 'order' => 'asc']) }}"><i class="fa fa-arrow-circle-up"></i></a>
	      						   <a href="{{ route('order', ['field' => 'start_date', 'order' => 'desc']) }}"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search" method="GET" action="{{ route('search') }}">
	      		<input type="hidden" name="search_field" value="start_date">
				<div class="input-group mb-3">
				  <input type="date" id="search_value" name="search_value" class="form-control" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">SALARY  <a href="{{ route('order', ['field' => 'salary', 'order' => 'asc']) }}"><i class="fa fa-arrow-circle-up"></i></a>
	      						  <a href="{{ route('order', ['field' => 'salary', 'order' => 'desc']) }}"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search" method="GET" action="{{ route('search') }}">
	      		<input type="hidden" name="search_field" value="salary">
				<div class="input-group mb-3">
				  <input type="number" id="search_value" name="search_value" class="form-control" placeholder="9999.00" max="9999.99" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	    </tr>

	  </thead>

    @foreach($employees as $employee)

	    <tr>

	        <td> {{ $employee->id }} </td>
	        <td> {{ $employee->parent_id }} </td>
	        <td> {{ $employee->full_name }} </td>
	        <td> {{ $employee->position }} </td>
	        <td> {{ $employee->start_date }} </td>
	        <td> {{ $employee->salary }} </td>

	    </tr>

    @endforeach

	</table>

@endsection