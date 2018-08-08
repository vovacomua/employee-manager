@extends('layouts.master')


@section('scripts')

	@include ('list.ajax')

@endsection


@section('content')
	
	@include ('layouts.errors')

	@if (\Session::has('success'))
      <div class="alert alert-success mt-3">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
 	@endif

 	<a href="{{action('EmployeeController@create')}}" class="btn btn-success mt-3 mb-3"> + Create New Employee </a>

	<table class="table table-striped">

	  <thead>
	    <tr>

	      <th scope="col"></th>

	      <th scope="col">ID 	<div>	<a href="#" class="order" data-values="field=id&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      								<a href="#" class="order" data-values="field=id&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      						</div>
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

	      <th scope="col">BOSS ID 	<div>	<a href="#" class="order" data-values="field=parent_id&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      									<a href="#" class="order" data-values="field=parent_id&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      							</div>
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

	      <th scope="col">FULL NAME  <div>	<a href="#" class="order" data-values="field=full_name&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
									 		<a href="#" class="order" data-values="field=full_name&order=desc"><i class="fa fa-arrow-circle-down"></i></a>
									 </div>
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

	      <th scope="col">POSITION <div>	<a href="#" class="order" data-values="field=position&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      									<a href="#" class="order" data-values="field=position&order=desc"><i class="fa fa-arrow-circle-down"></i></a>		
	      							</div>
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

	      <th scope="col">STARTED <div>		<a href="#" class="order" data-values="field=start_date&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      						   			<a href="#" class="order" data-values="field=start_date&order=desc"><i class="fa fa-arrow-circle-down"></i></a>
	      						  </div>
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

	      <th scope="col">SALARY <div> 	<a href="#" class="order" data-values="field=salary&order=asc"><i class="fa fa-arrow-circle-up"></i></a>
	      						 		<a href="#" class="order" data-values="field=salary&order=desc"><i class="fa fa-arrow-circle-down"></i></a>
	      						</div>
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

	      <th scope="col"></th>

	      <th scope="col"></th>

	    </tr>

	  </thead>

	  <tbody>

    @foreach($employees as $employee)

	    <tr>

	    	<td> <img src="{{((intval($employee->has_photo) == 1) ? asset('photos/'.$employee->id.'.jpg') : asset('photos/no-photo.jpg'))}}" style="max-height:40px; max-width:40px"></td>
	        <td> {{ $employee->id }} </td>
	        <td> {{ $employee->parent_id }} </td>
	        <td> {{ $employee->full_name }} </td>
	        <td> {{ $employee->position }} </td>
	        <td> {{ $employee->start_date }} </td>
	        <td> {{ $employee->salary }} </td>

	        <td>
	        	<a href="{{action('EmployeeController@edit', $employee->id)}}" class="btn btn-warning"> <i class="fas fa-edit"></i> </a>
	        </td>

	        <td>
		        <form action="{{action('EmployeeController@destroy', $employee->id)}}" method="post">
		          {{csrf_field()}}
		          <input name="_method" type="hidden" value="DELETE">
		          <button class="btn btn-danger" type="submit"> <i class="far fa-trash-alt"></i> </button>
		        </form>
	        </td>

	    </tr>

    @endforeach

      </tbody>

	</table>

@endsection