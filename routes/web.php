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
Route::get('/notes', 'NoteController@index')->name('notes.index');
Route::get('/notes/show/{id}', 'NoteController@show')->name('notes.show');
Route::get('/notes/delete/{id}', 'NoteController@delete')->name('notes.delete');
Route::get('/notes/store', 'NoteController@store')->name('notes.store');
Route::post('/notes/update', 'NoteController@update')->name('notes.update');
