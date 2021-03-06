<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserRecipesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource("registration", RegistrationController::class)->only(['store']);
Route::apiResource("categories", CategoryController::class)->only(['index']);
Route::apiResource("recipes", RecipeController::class);
Route::apiResource("users.recipes", UserRecipesController::class)->only(['index']);


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, "login"])->name("login");
    Route::post('logout',  [AuthController::class, "logout"])->name("logout");
});
