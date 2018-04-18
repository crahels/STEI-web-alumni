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

Route::get('/', 'HomeController@index');

Route::get('/profilemember/{id}', 'MembersController@showMyProfile');

Route::get('/profilemember/{id}/edit', 'MembersController@showMyProfile');

Route::get('/editMyProfile/{id}', 'MembersController@editMember');

Route::get('/about', function () {
	return view('about');
});

Route::resource('members', 'MembersController');

Route::post('/importcsv','AddMemberController@importCSV');
Route::post('/importmember','AddMemberController@importMember');

Route::resource('profile', 'MembersController');
Route::resource('addmember', 'AddMemberController');
Route::resource('posts', 'PostsController');
Route::resource('article', 'PostsController');


Route::get('/admin/dashboard', 'DashboardController@index');
Route::get('/members/{user}/delete', 'MembersController@destroy');

Route::get('login', 'Auth\SocialAccountsController@index');
Route::get('login/{provider}', 'Auth\SocialAccountsController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountsController@handleProviderCallback');
Route::get('/reverify/token/{token}', 'Auth\VerificationController@reverify')->name('auth.reverify'); 
Route::get('/verify/token/{token}', 'Auth\VerificationController@verify')->name('auth.verify'); 
Route::get('/verify/resend', 'Auth\VerificationController@resend')->name('auth.verify.resend');
Route::get('logout', 'Auth\SocialAccountsController@logout');
Route::get('link/{provider}', 'Auth\LinkAccountController@redirectToProvider');
Route::get('link/{provider}/delete', 'Auth\LinkAccountController@deleteLink');

Route::get('/add', function () {
	return view('admin.addmember');
})->middleware('admin');

Route::get('/addCSV', function () {
	return view('admin.addCSV');
})->middleware('admin');

//Admin page
Route::group( [ 'prefix' => 'admin' ], function()
{
	// Authentication Routes...
	$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
	$this->post('login', 'Auth\LoginController@login');
	$this->post('logout', 'Auth\LoginController@logout')->name('logout');

	// Registration Routes...
	$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	$this->post('register', 'Auth\RegisterController@register');

	// Password Reset Routes...
	$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	$this->post('password/reset', 'Auth\ResetPasswordController@reset');
});	