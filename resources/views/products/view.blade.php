@extends('layouts/app')

@section('content')

<div class="container">
<h2>Product Information</h2>

		<div class="card">	
			<div class="card-header">
			<b>{{$product->name}}</b>
		</div>
		<div class="card-body">
			Brand : {{$product->brand}}
		</div>
		<div class="card-footer">
			Model : {{$product->model}}
		</div>	
		</div>

		<hr>

		<h3>Complains</h3>

		



</div>

@endsection