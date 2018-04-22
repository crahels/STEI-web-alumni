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
    return view('home');
});

Route::get('/dashboard-member', function () {
    return view('dashboard-member');
});

/*Route::resource('members', 'MembersController');
Route::post('/importcsv','AddMemberController@importCSV');
Route::post('/importmember','AddMemberController@importMember');

Route::resource('profile', 'MembersController');
Route::resource('addmember', 'AddMemberController');
Route::resource('posts', 'PostsController');
Route::resource('questions', 'QuestionsController');
Route::resource('answers', 'AnswersController');*/

Route::get('login', 'Auth\SocialAccountsController@index');
Route::get('login/{provider}', 'Auth\SocialAccountsController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountsController@handleProviderCallback');
Route::get('/reverify/token/{token}', 'Auth\VerificationController@reverify')->name('auth.reverify'); 
Route::get('/verify/token/{token}', 'Auth\VerificationController@verify')->name('auth.verify'); 
Route::get('/verify/resend', 'Auth\VerificationController@resend')->name('auth.verify.resend');
Route::get('logout', 'Auth\SocialAccountsController@logout');
Route::get('link/{provider}', 'Auth\LinkAccountController@redirectToProvider');
Route::get('link/{provider}/delete', 'Auth\LinkAccountController@deleteLink');

// route for member
Route::resource('profile', 'MembersController');
Route::resource('posts', 'PostsController');
Route::resource('questions', 'QuestionsController');
Route::resource('answers', 'AnswersController');
Route::resource('members', 'MembersController');

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

	// admin route
	Route::resource('profile', 'MembersController');
	Route::resource('addmember', 'AddMemberController');
	Route::resource('posts', 'PostsController');
	Route::resource('questions', 'QuestionsController');
	Route::resource('answers', 'AnswersController');
	Route::resource('members', 'MembersController');
	
	Route::post('/importcsv','AddMemberController@importCSV');
	Route::post('/importmember','AddMemberController@importMember');

	Route::post('/answers/rate/{answer}/{user}', 'AnswersController@giveRating');
	Route::post('/answers/pin/{answer}/{question}/{each}', 'AnswersController@givePin');
	Route::get('/answers/add/{question}', 'AnswersController@giveAnswer');
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/members/{user}/delete', 'MembersController@destroy');
	Route::post('/answers/{each}', 'AnswersController@store');

	Route::get('/add', function () {
		return view('admin.addmember');
	})->middleware('admin');
	
	Route::get('/addCSV', function () {
		return view('admin.addCSV');
	})->middleware('admin');

	Route::post('/answer/store_ajax', 'AnswersController@storeAjax');	
});