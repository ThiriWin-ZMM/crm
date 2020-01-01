<?php

namespace App\Http\Controllers;

use App\Product;
use App\Complain;

class ProductController extends Controller
{
    public function index()
	{
		$products=Product::orderBy('id','desc')->paginate(5);
		return view('products.index',['products'=>$products]);
	}

	public function view($id)
	{
		$products=Product::find($id);
		return view('products.view',['product'=>$products]);
	}

	public function add()
	{
		return view('products.add');
	}

	public function create()
	{
		$validator=validator(request()->all(),[
			'name'=>'required|min:3',
			'brand'=>'required',
			'model'=>'required'
		]);

		if($validator->fails()){
			return redirect('/products/add')->withErrors($validator);
		}

		$product=new Product();
		$product->name=request()->name;
		$product->brand=request()->brand;
		$product->model=request()->model;
		$product->save();

		return redirect('/products')->with('info','A Product Added');
	}

	public function edit($id)
	{
		$product=Product::find($id);
		return view('products.edit',['product'=>$product]);
	}

	public function update($id)
	{
		$validator=validator(request()->all(),[
			'name'=>'required|min:3',
			'brand'=>'required',
			'model'=>'required'
		]);

		if($validator->fails()){
			return redirect('/product/edit/'.$id)->withErrors($validator);
		}

		$product=Product::find($id);
		$product->name=request()->name;
		$product->brand=request()->brand;
		$product->model=request()->model;
		$product->save();

		return redirect('/products')->with('info','A Customer updated');
	}

	public function delete($id)
	{
		$product=Product::find($id);
		$product->delete();

		return redirect('/products')->with('info','A product deleted');
	}
}
