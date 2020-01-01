<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*======Customer Routes=========*/

Route::get('/customers','CustomerController@index');
Route::get('/customers/view/{id}','CustomerController@view');

Route::get('/customers/add','CustomerController@add');
Route::post('/customers/add','CustomerController@create');

Route::get('/customers/edit/{id}','CustomerController@edit');
Route::post('/customers/edit/{id}','CustomerController@update');

Route::get('/customers/delete/{id}','CustomerController@delete');

/*======Complains Routes=========*/

Route::get('/complains','ComplainController@index');
Route::get('/complains/view/{id}','ComplainController@view');

Route::get('/complains/add','ComplainController@add');
Route::post('/complains/add','ComplainController@create');

Route::get('/complains/edit/{id}','ComplainController@edit');
Route::post('/complains/edit/{id}','ComplainController@update');

Route::get('/complains/delete/{id}','ComplainController@delete');

Route::get('/complains/filter/{status}','ComplainController@filter');

Route::get('/complains/status/{id}/{status}','ComplainController@status');
Route::get('/complains/assign/{id}/{user}','ComplainController@assign');


/*======Complains Routes=========*/

Route::get('/products','ProductController@index');
Route::get('/products/view/{id}','ProductController@view');

Route::get('/products/add','ProductController@add');
Route::post('/products/add','ProductController@create');

Route::get('/products/edit/{id}','ProductController@edit');
Route::post('/products/edit/{id}','ProductController@update');

Route::get('/products/delete/{id}','ProductController@delete');
Route::get('/products/delete/{id}','ProductController@delete');

/*=======Comment Routes=========*/ 

Route::post('/comments/add', 'ComplainController@addcomment');





Route::get('/', 'ComplainController@index');

Auth::routes();

Route::get('/home', 'ComplainController@index')->name('home');
