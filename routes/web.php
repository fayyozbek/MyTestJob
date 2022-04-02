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
Route::get('/', 'App\Http\Controllers\MyController@home');

Route::get('/test', 'App\Http\Controllers\MyController@test');
Route::get('/logout', 'App\Http\Controllers\MyController@logout');
Route::get('/update', 'App\Http\Controllers\MyController@update');

Route::get('/login', 'App\Http\Controllers\MyController@login')->name('login');
Route::post('/login/check','\App\Http\Controllers\MyController@comments_check');
Route::post('/signup/check','\App\Http\Controllers\MyController@register')->name('sign');
Route::post('/user/check','\App\Http\Controllers\MyController@request_check')->name('user');
Route::get('/signup', 'App\Http\Controllers\MyController@sign');
Route::get('/manager', 'App\Http\Controllers\MyController@manager')->name('manager');
Route::get('/user', 'App\Http\Controllers\MyController@user')->name('form');

