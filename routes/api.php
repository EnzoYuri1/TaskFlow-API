<?php

use App\Domains\Tasks\Controller\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rotas Públicas: Acessíveis sem autenticação
Route::post('login', [AuthController::class, 'login']);

// Rotas Protegidas: Requerem token de acesso via Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Gerenciamento de Tarefas
    Route::apiResource('tasks', TaskController::class);
    Route::patch('tasks/{id}/complete', [TaskController::class, 'complete']);
});
