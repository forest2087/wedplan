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

//home page route to welcome view
Route::get('/', function () {
        return view('welcome');
});

//map /home to homecontroller
Route::any('home', 'HomeController@index');


