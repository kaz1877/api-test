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

Route::get('/GET recipes', [RecipeController::class, 'index']);
Route::post('/POST recipes', [RecipeController::class, 'store']);
Route::get('/GET/{id} recipe', [RecipeController::class, 'show']);
Route::put('/PATCH/{id} recipe', [RecipeController::class, 'update']);
Route::delete('/DELETE/{id} recipe', [RecipeController::class, 'delete']);
