@extends('layouts.master')

@section('content')

	<table class="table table-striped">

	  <thead>
	    <tr>
	      <th scope="col">ID 		<a href="/restricted/?field=id&order=asc">&uarr;</a> 		<a href="/restricted/?field=id&order=desc">&darr;</a>		</th>
	      <th scope="col">BOSS ID 	<a href="/restricted/?field=parent_id&order=asc">&uarr;</a> <a href="/restricted/?field=parent_id&order=desc">&darr;</a></th>
	      <th scope="col">FULL NAME <a href="/restricted/?field=full_name&order=asc">&uarr;</a> <a href="/restricted/?field=full_name&order=desc">&darr;</a></th>
	      <th scope="col">POSITION 	<a href="/restricted/?field=position&order=asc">&uarr;</a> 	<a href="/restricted/?field=position&order=desc">&darr;</a>	</th>
	      <th scope="col">STARTED 	<a href="/restricted/?field=start_date&order=asc">&uarr;</a> <a href="/restricted/?field=start_date&order=desc">&darr;</a></th>
	      <th scope="col">SALARY 	<a href="/restricted/?field=salary&order=asc">&uarr;</a> 	<a href="/restricted/?field=salary&order=desc">&darr;</a>	</th>
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