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
Route::get('/notes/create', 'NoteController@create')->name('notes.create');
Route::get('/notes/update/{id}', 'NoteController@update')->name('notes.update');
Route::get('/notes/delete/{id}', 'NoteController@delete')->name('notes.delete');
Route::get('/share/{id}', 'ShareController@index')->name('share.index');
Route::get('/files/delete', 'FileController@delete')->name('file.delete');
Route::get('/files/download', 'FileController@download')->name('file.download');

Route::post('/notes/quickEdit', 'NoteController@quickEdit')->name('notes.quickEdit');
Route::post('/notes/fullEdit', 'NoteController@fullEdit')->name('notes.fullEdit');
Route::post('/notes/create', 'NoteController@store')->name('notes.store');
Route::post('/search', 'SearchController@search')->name('search');

