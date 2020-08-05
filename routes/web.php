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

Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/transactions/create','TransactionsController@create')->name('trans.create');
Route::post('/transactions','TransactionsController@store')->name('trans.store');
Route::get('/transactions/{transaction}','TransactionsController@show')->name('trans.show');

Route::post('/transactions/{transaction}/records','RecordsController@store')->name('rec.store');
    