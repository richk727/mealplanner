<?php

use App\Recipe;

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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/recipes', 'RecipesController@index');
    Route::get('/recipes/create', 'RecipesController@create');
    Route::get('/recipes/{recipe}', 'RecipesController@show');    
    Route::post('/recipes', 'RecipesController@store');

    Route::get('/home', 'HomeController@index')->name('home');
});

