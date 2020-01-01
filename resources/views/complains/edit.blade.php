@extends('layouts/app')

@section('content')

<div class="container">
	<h2>Edit Complain</h2>

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
			<label>Subject</label>
			<input type="text" name="subject" class="form-control" value="{{$complain->subject}}">	
		</div>
		<div class="form-group">
			<label>Detail</label>
			<input type="text" name="detail" class="form-control" value="{{$complain->detail}}">
		</div>
		<input type="submit" value="Update Complain" class="btn btn-primary">
	</form>	
</div>

@endsection
