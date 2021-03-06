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

// ログイン後トップ
Route::get('/home', 'HomeController@index')->name('home');

// 画像詳細
Route::get('detail', [
    'uses'  => 'ImageController@detail',
]);
// 画像アップロード
Route::post('/detail/store', [
    'uses'  => 'UploadController@store',
]);

// 画像アップロード
Route::post('/detail/edit', [
    'uses'  => 'ImageController@edit',
]);
