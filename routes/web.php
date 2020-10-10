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

Route::group(['middleware' => 'actived', 'prefix' => "admin"], function (){

    /********* TABLEAU DE BORD ****************/
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@index');

    /********* UTILISATEUR ****************/
    Route::resource('/user', 'UserController');
    Route::post('/disable/user/{id}', 'UserController@disable')->name('user.disable');
    Route::get('update-password', 'UserController@password')->name('password');
    Route::put('update-password', 'UserController@passwordUpdate')->name('password.new');

    /********* ROLE ****************/
    Route::resource('/role', 'RoleController');

    Route::resource('meetups', 'MeetupController');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

