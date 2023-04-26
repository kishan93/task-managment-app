<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['nullable', 'max:255'],
            'project_id' => ['required', 'exists:projects,id'],
            'status' => ['required', 'in:todo,in_progress,done'],
            'priority' => ['nullable', 'numeric', 'between:1,100'],
        ];
    }
}