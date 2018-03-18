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
    return '<h1>Under Construction</h1>';
});

Route::post('/importcsv','AddMemberController@importCSV');
Route::post('/importmember','AddMemberController@importMember');

Route::resource('profile', 'MembersController');
Route::resource('addmember', 'AddMemberController');