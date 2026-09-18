<?php

namespace App\Domains\Tasks\Service;

use App\Domains\Tasks\Enums\TaskStatus;
use App\Domains\Tasks\Model\Task;
use Illuminate\Support\Collection;

class TaskService
{
    /**
     * Cria uma nova tarefa no sistema.
     */
    public function createTask(array $data): Task
    {
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? TaskStatus::Pending,
            'due_date' => $data['due_date'] ?? null,
        ]);
    }

    /**
     * Atualiza uma tarefa existente.
     *
     * Filtra valores nulos para campos obrigatórios para evitar erros
     * quando a interface envia campos vazios em requisições parciais.
     */
    public function updateTask(string $id, array $data): Task
    {
        $task = Task::findOrFail($id);

        // Remove valores nulos de campos não-anuláveis para evitar erros de banco de dados
        // Isso permite que ferramentas de UI enviem nulls para campos não alterados.
        foreach (['title', 'status'] as $field) {
            if (array_key_exists($field, $data) && is_null($data[$field])) {
                unset($data[$field]);
            }
        }

        $task->update($data);

        return $task;
    }

    /**
     * Recupera todas as tarefas cadastradas.
     */
    public function getAllTasks(): Collection
    {
        return Task::all();
    }

    /**
     * Recupera os detalhes de uma tarefa específica pelo ID.
     */
    public function getTaskById(string $id): Task
    {
        return Task::findOrFail($id);
    }

    /**
     * Remove permanentemente uma tarefa do sistema.
     */
    public function deleteTask(string $id): bool
    {
        return Task::destroy($id) > 0;
    }

    /**
     * Marca uma tarefa como concluída.
     */
    public function markAsCompleted(string $id): Task
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => TaskStatus::Completed]);

        return $task;
    }
}
