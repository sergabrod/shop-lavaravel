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
Route::get('/', 'TestController@welcome');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
  Route::get('/products', 'ProductController@index'); //listado de productos
  Route::get('/products/create', 'ProductController@create'); //crear nuevos productos
  Route::post('/products', 'ProductController@store'); //guardar nuevos productos

  Route::get('/products/{id}/edit', 'ProductController@edit'); //form de edición
  Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar productos

  Route::delete('/products/{id}', 'ProductController@destroy'); //eliminar productos
});
