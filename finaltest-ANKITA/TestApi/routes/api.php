<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [UserController::class, 'login']);



Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user-info', [UserController::class, 'getuserInfo']);
    Route::get('/log-out', [UserController::class, 'logout']);
    Route::get('/get-master-data', [EmployeeController::class, 'getMasterData']);
    Route::get('/get-all-employee-details', [EmployeeController::class, 'getAllEmployeeDetails']);
    Route::post('/add-employee', [EmployeeController::class, 'addEmployee']);
    Route::post('/get-employee-details-by-id', [EmployeeController::class, 'getEmployeeDetails']);
});
