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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'  => 'auth'], function() {

    Route::get('/home', 'HomeController@index')->name('home');

    /*
    ***********************************************************************
    >>>> Genders
    ***********************************************************************
    */

    // List
    Route::get('/genders', 'GenderController@index');

    // Store
    Route::post('/genders', 'GenderController@store');

    // List json
    Route::get('/genders/list-genders', 'GenderController@getGenders');

    // Info
    Route::get('/genders/{gender}', 'GenderController@getInfo');

    // Update
    Route::patch('/genders-update/{gender}', 'GenderController@update');

    // Inactive
    Route::patch('/genders-inactive/{gender}', 'GenderController@inactive');

    // Active
    Route::patch('/genders-active/{gender}', 'GenderController@active');

});
