@extends('layouts/app')

@section('content')

<div class="container">
	<h2>Product List</h2>

	@if(session('info'))
	<div class="alert alert-info">
		{{session('info')}}		
	</div>
	@endif

	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Brand</th>
			<th>Model</th>
			<th>#</th>
		</tr>
		@foreach($products as $product)
		<tr>
			<td>{{$product->id}}</td>
			<td><a href="{{url('products/view/'.$product->id)}}">{{$product->name}}</a></td>
			<td>{{$product->brand}}</td>
			<td>{{$product->model}}</td>
			<td>
				<a href="{{url('products/edit/'.$product->id)}}"><i class="fa fa-edit"></i></a>
				<a href="{{url('products/delete/'.$product->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		@endforeach		
	</table>
	{{$products->links()}}	
</div>

@endsection