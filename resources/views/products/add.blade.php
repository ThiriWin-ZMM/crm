@extends('layouts/app')

@section('content')

<div class="container">
	<h2>New Product</h2>

	@if($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif


	<form method="post">
		{{csrf_field()}}
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control">			
		</div>
		<div class="form-group">
			<label>Brand</label>
			<input type="text" name="brand" class="form-control">
		</div>
		<div class="form-group">
			<label>Model</label>
			<input type="text" name="model" class="form-control">
		</div>
		<input type="submit" value="Add Product" class="btn btn-primary">
	</form>	
</div>

@endsection
