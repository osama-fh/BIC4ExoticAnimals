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

Route::get('/', 'GuestController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('animal', 'AnimalController');
Route::resource('species', 'SpeciesController');

Route::get('/search/animal', 'AnimalController@search')->name('animal.search');
Route::post('/search/animal', 'AnimalController@query')->name('animal.query');

Route::get('/list/species', 'SpeciesController@list')->name('species.list');
Route::get('/list/animal', 'AnimalController@list')->name('animal.list');
