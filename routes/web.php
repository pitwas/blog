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
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/editProfile', 'ProfileController@editProfile')->name('editProfile');
Route::get('/post', 'PostController@index')->name('post');
Route::post('/addPost', 'PostController@addPost')->name('addPost');
Route::get('/myPost', 'PostController@myPost')->name('myPost');
Route::get('/home/ajaxRequest', 'AjaxController@ajaxRequest');
Route::post('/home/ajaxRequest', 'AjaxController@ajaxRequestPost');
Route::get('/myPost/ajaxRequest', 'AjaxController@ajaxRequest');
Route::post('/myPost/ajaxRequest', 'AjaxController@ajaxRequestPost');
Route::get('/post/update/{id}', 'PostController@update');
Route::post('/post/update/{id}', 'PostController@updatePost');