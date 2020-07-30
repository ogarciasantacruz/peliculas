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
    

    /*
    ***********************************************************************
    >>>> Movies
    ***********************************************************************
    */

    // List
    Route::get('/movies', 'MovieController@index');

    // Store
    Route::post('/movies', 'MovieController@store');

    // List json
    Route::get('/movies/list-movies', 'MovieController@getMovies');

    // Info
    Route::get('/movies/{movie}', 'MovieController@getInfo');

    // Update
    Route::put('/movies-update/{movie}', 'MovieController@update');    


    /*
    ***********************************************************************
    >>>> Users
    ***********************************************************************
    */

    // List
    Route::get('/users', 'UserController@index');

    // Movies user
    Route::get('/users/{user}/movies', 'UserController@getMovies');

});
