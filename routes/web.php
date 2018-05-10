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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/',       'TopController@index');
Route::get('/list',   'ListController@index');
Route::get('/upload', 'UploadController@index');
Route::get('/image',  'ImageController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');