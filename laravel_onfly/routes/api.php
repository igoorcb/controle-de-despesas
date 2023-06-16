<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpensesController;

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
//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Expenses
Route::post('/register_expenses', [ExpensesController::class, 'save']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/show_expenses', [ExpensesController::class, 'show']);
    Route::post('/delete', [ExpensesController::class, 'delete']);
});