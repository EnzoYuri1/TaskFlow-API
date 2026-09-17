<?php

use Illuminate\Support\Facades\Route;
use App\Domains\Tasks\Controller\TaskController;
use App\Http\Controllers\AuthController;

// Rotas Públicas
Route::post('login', [AuthController::class, 'login']);

// Rotas Protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('tasks', TaskController::class);
    Route::patch('tasks/{id}/complete', [TaskController::class, 'complete']);
});
