<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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
Route::post('register', [AuthController::class, 'register']);
Route::post('verifyotp', [AuthController::class, 'verifyotp']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('details', [AuthController::class, 'detail'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('procreate', [ProjectController::class, 'store']);
    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('projects/{id}', [ProjectController::class, 'show']);
    Route::put('projects/update/{id}', [ProjectController::class, 'update']);
    Route::delete('projects/delete/{id}', [ProjectController::class, 'destroy']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('taskcreate', [TaskController::class, 'store']);
    Route::get('tasks', [TaskController::class, 'index']);
    Route::get('tasks/{id}', [TaskController::class, 'show']);
    Route::put('tasks/update/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/delete/{id}', [TaskController::class, 'destroy']);
    Route::get('tasks/project/{id}', [TaskController::class, 'showProjectTask']);
    
});