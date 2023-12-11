<?php

use App\Http\Controllers\Api\IngredientWikiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Api'], function () {
  Route::post('/login', 'UserController@createUser');
  Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::any('/ingredient_wiki', 'IngredientWikiController@ingredientWiki');
    Route::any('/recipeList', 'RecipeController@recipeList');
    Route::any('/recipeDetail', 'RecipeController@recipeDetail');
    Route::delete('/recipeDelete', 'RecipeController@deleteRecipe');
    Route::any('/recipe', 'RecipeController@addRecipe');
  });
});
