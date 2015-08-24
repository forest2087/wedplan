<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//home page
Route::get('/', function () {
    return view('home.index')->with('content', 'You are in Laravel!');
});


//map /home to homecontroller
Route::any('home', 'HomeController@index');

//list users
Route::any('user', 'UserController@index');

//product page
Route::resource('product', 'PackageController');

//payment page
Route::any('pay/{id}', 'PaymentController@index');
Route::any('pay', 'PackageController@index');

//process payment
Route::post('process', 'PaymentController@process');

//admin dashboard
//Route::get('admin', 'AdminController@index');

Route::group([
    'middleware' => 'auth',
], function () {
    resource('admin', 'AdminController');
});


//user auth tutorial
//https://laraveltips.wordpress.com/tag/user-registration-laravel-5-1/
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::controllers([
    'password' => 'Auth\PasswordController',
]);

