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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/event')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', 'EventController@index')->name('event.index');
        Route::get('/create', 'EventController@create')->name('event.create');
        Route::get('/edit/{id}', 'EventController@edit')->name('event.edit');
        Route::put('/edit/{id}', 'EventController@update')->name('event.update');
        Route::post('/', 'EventController@store')->name('event.store    ');
        Route::delete('/{id}', 'EventController@delete')->name('event.delete');

        Route::get('export', 'EventController@export')->name('export');
        Route::post('import', 'EventController@import')->name('import');
        Route::get('importExportView', 'EventController@importExportView');
    });
});