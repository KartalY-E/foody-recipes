<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\CategoryController;
use SebastianBergmann\Environment\Console;
use App\Models\Meal;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// search for meals
Route::post('/search', [MealController::class, 'searchMeal'])->name('search');

// random 6 meals
Route::get('/random', [MealController::class, 'random']);

// get all Categories
Route::get('/categories', [CategoryController::class, 'categories']);

// search for meals per Category
Route::post('/search-categories', [MealController::class, 'searchMealCategory'])->name('categories.search');



Route::middleware('auth')->get('/favorite/{meal:slug}', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});

Route::middleware('auth:sanctum')
    ->get('/favorite/{meal:slug}', [MainController::class, 'favoriteToggle']);

Route::middleware('auth:sanctum')
    ->get('/favorites', [MainController::class, 'userFavorites']);
