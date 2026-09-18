<?php

namespace App\Domains\Tasks\Controller;

use App\Domains\Tasks\Resources\TaskResource;
use App\Domains\Tasks\Service\TaskService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {}

    /**
     * Listar Todas as Tarefas
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAllTasks();

        return response()->json(TaskResource::collection($tasks), 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Criar Nova Tarefa
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->createTask($request->validated());

        return response()->json(new TaskResource($task), 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Detalhes da Tarefa
     */
    public function show(string $id): JsonResponse
    {
        $task = $this->taskService->getTaskById($id);

        return response()->json(new TaskResource($task), 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Atualizar Tarefa
     */
    public function update(UpdateTaskRequest $request, string $id): JsonResponse
    {
        $task = $this->taskService->updateTask($id, $request->validated());

        return response()->json(new TaskResource($task), 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Excluir Tarefa
     */
    public function destroy(string $id): JsonResponse
    {
        $this->taskService->deleteTask($id);

        return response()->json(null, 204);
    }

    /**
     * Marcar Tarefa como Concluída
     */
    public function complete(string $id): JsonResponse
    {
        $task = $this->taskService->markAsCompleted($id);

        return response()->json(new TaskResource($task), 200, [], JSON_UNESCAPED_UNICODE);
    }
}
