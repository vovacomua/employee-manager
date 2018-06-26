@extends('layouts.master')

@section ('content')

	<div class="col-md-8">

		<h1>Sign In</h1>

		<form method="POST" action="/login">
			{{ csrf_field() }}

			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="email" required>
			</div>

			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" name="password" required>
			</div>
			

			<div class="form-group clearfix">
				<button type="submit" class="btn btn-primary float-left">Sign In</button>
				<h4 class="float-right">or <a href="{{ url('/register') }}">register</a></h4>
			</div>

			@include ('layouts.errors')

		</form>


	</div>

@endsection