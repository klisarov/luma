<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('task')->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where(fn ($q) => $q->where('user_id', $userId)),
            ],
            'subcategory_id' => [
                'nullable',
                Rule::exists('subcategories', 'id')->where(function ($q) use ($userId) {
                    $q->whereIn('category_id', function ($sub) use ($userId) {
                        $sub->select('id')->from('categories')->where('user_id', $userId);
                    });
                }),
            ],
            'due_at' => ['nullable', 'date'],
            'reminder_offset_minutes' => ['nullable', 'integer', 'min:0'],
            'is_work_related' => ['nullable', 'boolean'],
            'priority' => ['nullable', 'integer', 'between:1,3'],
            'is_completed' => ['nullable', 'boolean'],
        ];
    }
}