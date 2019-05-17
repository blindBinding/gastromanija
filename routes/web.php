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




Route::get('/', 'PagesController@index');
Route::get('/admin', 'PagesController@admin');
Route::get('/user', 'PagesController@user');
   
Route::resource('recipes', 'RecipesController');
Auth::routes(['verify' => true]);


Route::get('/dashboard', 'DashboardController@index');
