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
    return view('index');
});

Route::resource('employees', 'EmployeeController');

Route::resource('teams', 'TeamController');

Route::resource('shifts', 'ShiftController');

Route::post('/shifts/search', 'ShiftController@search')->name('shifts.search');