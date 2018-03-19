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

Route::get('/', function () {
    return view('layouts.app');
});
Auth::routes();
Route::resource('members', 'MembersController');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/add', function () {
	return view('addMember');
});
Route::get('/addCSV', function () {
	return view('addCSV');
});