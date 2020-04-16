<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('home', 'HomeController@index')->name('home');

Route::group( ['middleware' => 'auth' ], function(){

	Route::resource('robots', 'RobotController'); 
	Route::get('robots/create', 'RobotController@create'); 

	Route::get('fight/fetch', 'FightController@fetch')->name('FightController.fetch');
	Route::get('fight/whowin', 'FightController@whowin')->name('FightController.whowin');
	Route::resource('fight', 'FightController'); 

});

