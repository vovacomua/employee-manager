@extends('layouts.master')


@section('scripts')

	@include ('list.ajax')

@endsection


@section('content')
	
	@include ('layouts.errors')

	<table class="table table-striped">

	  <thead>
	    <tr>

	      <th scope="col">ID  	<a href="#" class="order" data-values="field=id&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      						<a href="#" class="order" data-values="field=id&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search">
	      		<input type="hidden" name="search_field" value="id">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="1" pattern="^\d{1,10}$" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">BOSS ID   <a href="#" class="order" data-values="field=parent_id&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      							<a href="#" class="order" data-values="field=parent_id&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search">
	      		<input type="hidden" name="search_field" value="parent_id">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="1" pattern="^\d{1,10}$" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">FULL NAME  <a href="#" class="order" data-values="field=full_name&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
									 <a href="#" class="order" data-values="field=full_name&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search">
	      		<input type="hidden" name="search_field" value="full_name">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="John Doe" maxlength="255" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">POSITION  <a href="#" class="order" data-values="field=position&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      							<a href="#" class="order" data-values="field=position&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search">
	      		<input type="hidden" name="search_field" value="position">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="Worker" maxlength="255" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">STARTED  <a href="#" class="order" data-values="field=start_date&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      						   <a href="#" class="order" data-values="field=start_date&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search">
	      		<input type="hidden" name="search_field" value="start_date">
				<div class="input-group mb-3">
				  <input type="date" id="search_value" name="search_value" class="form-control" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	      <th scope="col">SALARY  <a href="#" class="order" data-values="field=salary&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      						  <a href="#" class="order" data-values="field=salary&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      	<form class="search">
	      		<input type="hidden" name="search_field" value="salary">
				<div class="input-group mb-3">
				  <input type="text" id="search_value" name="search_value" class="form-control" placeholder="99999.00" pattern="^\d{1,5}(\.\d{2})?$" required>
				  <div class="input-group-append">
				    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search"></i></button>
				  </div>
				</div>
	      	</form>
	      </th>

	    </tr>

	  </thead>

	  <tbody>

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

      </tbody>

	</table>

@endsection