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

Route::get('/', 'TreeController@index')->name('home');

Route::get('/showtree', 'TreeController@showTree');
Route::get('/rebasetree', 'TreeController@rebaseTree');



Route::get('/register', 'RegistrationController@create');

Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create')->name('login');

Route::post('/login', 'SessionsController@store');

Route::get('/logout', 'SessionsController@destroy');


Route::get('/restricted', 'EmployeeController@index')->name('list');

Route::get('/restricted/employees/order', 'EmployeeController@order')->name('order');

Route::get('/restricted/employees/search', 'EmployeeController@search')->name('search');

Route::resource('/restricted/employees', 'EmployeeController');
