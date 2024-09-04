<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Business\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// 
Route::apiResource('user', UserController::class);
Route::apiResource('business', BusinessController::class);


Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('service', ServiceController::class);
    Route::post('update_service/{id}', [ServiceController::class, 'update']);
});



Route::post('update_business/{id}', [BusinessController::class, 'update']);

// /Middleware/Authenticate.php
Route::get('/auth', function() {
    return response()->json(['message' => 'please login first']);
})->name('auth');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
