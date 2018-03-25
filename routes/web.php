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

Route::post('/importcsv','AddMemberController@importCSV');
Route::post('/importmember','AddMemberController@importMember');

Route::resource('profile', 'MembersController');
Route::resource('addmember', 'AddMemberController');
Route::resource('posts', 'PostsController');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/members/{user}/delete', 'MembersController@destroy');

Route::get('/add', function () {
	return view('admin.addmember');
})->middleware('admin');

Route::get('/addCSV', function () {
	return view('admin.addCSV');
})->middleware('admin');