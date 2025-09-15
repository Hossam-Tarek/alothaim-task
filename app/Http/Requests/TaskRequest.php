<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks', 'title')->ignore($this->route('task'))
            ],
            'description' => 'required|string',
            'status' => [
                'required',
                'integer',
                Rule::in(array_column(TaskStatusEnum::cases(), 'value'))
            ],
            'assigned_to_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
            ],
        ];
    }
}
