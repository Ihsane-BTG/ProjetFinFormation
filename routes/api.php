<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReservationController;
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


Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth:sanctum');


Route::get('/reservations', [ReservationController::class, 'index']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::get('/reservations/{id}', [ReservationController::class, 'show']);
Route::put('/reservations/{id}', [ReservationController::class, 'update']);
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

Route::get('/categories', [CategoryController::class, 'index']); 
Route::get('/categories/{id}', [CategoryController::class, 'show']); 
Route::post('/categories', [CategoryController::class, 'store']); 
Route::put('/categories/{id}', [CategoryController::class, 'update']); 
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

Route::get('/menu', [MenuController::class, 'index']); 
Route::get('/menu/{id}', [MenuController::class, 'show']); 
Route::post('/menu', [MenuController::class, 'store']); 
Route::put('/menu/{id}', [MenuController::class, 'update']); 
Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

Route::get('/notifications', [NotificationController::class, 'index']); 
Route::get('/notifications/{id}', [NotificationController::class, 'show']); 
Route::post('/notifications', [NotificationController::class, 'store']); 
Route::put('/notifications/{id}', [NotificationController::class, 'update']); 
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);