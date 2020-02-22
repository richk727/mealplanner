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
    Route::resource('recipes', 'RecipesController');

    Route::post('/recipes/{recipe}/steps', 'RecipeStepsController@store');
    Route::patch('/recipes/{recipe}/steps/{step}', 'RecipeStepsController@update');
    Route::delete('/recipes/{recipe}/steps/{step}', 'RecipeStepsController@destroy');
    

    Route::post('/recipes/{recipe}/ingredients', 'RecipeIngredientsController@store');
    Route::patch('/recipes/{recipe}/ingredients/{ingredient}', 'RecipeIngredientsController@update');
    Route::delete('/recipes/{recipe}/ingredients/{ingredient}', 'RecipeIngredientsController@destroy');
});

