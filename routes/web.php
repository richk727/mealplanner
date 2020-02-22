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
    Route::get('/recipes/{recipe}/edit', 'RecipesController@edit');
    Route::patch('/recipes/{recipe}', 'RecipesController@update');

    Route::post('/recipes', 'RecipesController@store');

    Route::post('/recipes/{recipe}/steps', 'RecipeStepsController@store');
    Route::patch('/recipes/{recipe}/steps/{step}', 'RecipeStepsController@update');

    Route::post('/recipes/{recipe}/ingredients', 'RecipeIngredientsController@store');
    Route::patch('/recipes/{recipe}/ingredients/{ingredient}', 'RecipeIngredientsController@update');
});

