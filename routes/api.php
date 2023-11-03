<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticate\RegisterController;
use App\Http\Controllers\Authenticate\LoginController;
use App\Http\Controllers\Payment\Paymentcontroller;
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
Route::group(['middleware' => 'myAuth'], function () {

Route::post('register_user', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);


    Route::middleware('auth:sanctum')->group(function () {

        require_once __DIR__.'/customers.php';
    
    });

});

