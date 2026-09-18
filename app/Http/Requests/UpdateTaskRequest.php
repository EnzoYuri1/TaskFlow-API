<?php

namespace App\Http\Requests;

use App\Domains\Tasks\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define as regras de validação para a atualização de uma tarefa.
     *
     * O uso de 'sometimes' permite atualizações parciais (PATCH), validando
     * apenas os campos que foram enviados na requisição.
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|nullable|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => ['sometimes', 'nullable', Rule::enum(TaskStatus::class)],
            'due_date' => 'sometimes|nullable|date',
        ];
    }
}
