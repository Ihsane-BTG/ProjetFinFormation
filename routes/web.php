<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::post('/api/users/register', [AuthController::class, 'register']);
// Route::post('/api/users/login', [AuthController::class, 'login']);

// Route::middleware('auth:api')->group(function () {
//     Route::get('/users/user', 'AuthController@user');
//     Route::post('/users/logout', 'AuthController@logout');

//     Route::middleware('role:manager')->group(function () {
//         Route::post('/manager/create-menu', 'ManagerController@createMenu');
//     });

//     Route::middleware('role:waiter')->group(function () {
//         Route::post('/waiter/take-order', 'WaiterController@takeOrder');
//     });

//     Route::middleware('role:user')->group(function () {
//         Route::get('/user/menu', 'UserController@showMenu');
//     });
// });

Route::get('/menu', 'MenuController@index');