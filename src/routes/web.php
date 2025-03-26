<?php

use App\Http\Controllers\RecipeController;
use App\Models\Recipe;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/recipes', [RecipeController::class, 'index']);
Route::post('/recipes', [RecipeController::class, 'store']);
Route::get('/recipe/{id} ', [RecipeController::class, 'show']);
Route::put('/recipe/{id} ', [RecipeController::class, 'update']);
Route::delete('/recipe/{id} ', [RecipeController::class, 'delete']);
