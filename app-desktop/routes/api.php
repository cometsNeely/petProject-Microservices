<?php

use App\Http\Controllers\ShowController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RabbitMQRPCClientController;

Route::middleware('auth:sanctum')->group(function () {

    //Route::post('/shows', [ShowController::class, 'index']);

});

Route::post('/shows', [ShowController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/subscribe', [RabbitMQRPCClientController::class, 'subscribe']);