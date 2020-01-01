@extends('layouts/app')

@section('content')

<div class="container">
<h2>Customer Information</h2>

		<div class="card">	
			<div class="card-header">
			<b>{{$customer->name}}</b>
		</div>
		<div class="card-body">
			{{$customer->address}}
		</div>
		<div class="card-footer">
			Phone:{{$customer->phone}},
			Email:{{$customer->email}}
		</div>	
		</div>

		<hr>

		<h3>Complains</h3>
		
		<table class="table table-bordered table-striped">
			<tr>
				<th>ID</th>
				<th>Subject</th>
			</tr>
			@foreach($customer->complains as $complain)
			<tr>
				<td>{{$complain->id}}</td>
				<td>{{$complain->subject}}</td>
			</tr>
			@endforeach
		</table>
</div>

@endsection