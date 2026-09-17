<?php

namespace App\Domains\Tasks\Service;

use App\Domains\Tasks\Model\Task;
use App\Domains\Tasks\Enums\TaskStatus;
use Illuminate\Support\Collection;

class TaskService
{
    /**
     * Create a new task.
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
     * Update an existing task.
     */
    public function updateTask(string $id, array $data): Task
    {
        $task = Task::findOrFail($id);
        $task->update($data);

        return $task;
    }

    /**
     * List all tasks.
     */
    public function getAllTasks(): Collection
    {
        return Task::all();
    }

    /**
     * Get a single task by ID.
     */
    public function getTaskById(string $id): Task
    {
        return Task::findOrFail($id);
    }

    /**
     * Delete a task.
     */
    public function deleteTask(string $id): bool
    {
        return Task::destroy($id) > 0;
    }

    /**
     * Mark a task as completed.
     */
    public function markAsCompleted(string $id): Task
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => TaskStatus::Completed]);

        return $task;
    }
}
