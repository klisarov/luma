<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Work-oriented to-do list: tasks flagged is_work_related, most recent first.
     */
    public function workList()
    {
        $tasks = Auth::user()->tasks()
            ->where('is_work_related', true)
            ->with(['category', 'subcategory'])
            ->orderByDesc('due_at')
            ->paginate(20);

        return view('tasks.work-list', compact('tasks'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Auth::user()->tasks()->create($request->validated());

        return back()->with('status', 'Task added.');
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return back()->with('status', 'Task updated.');
    }

    /**
     * Toggle completion — called via fetch() from the dashboard checkbox
     * widgets, returns JSON so the frontend can update the % bar without
     * a full page reload.
     */
    public function toggleComplete(Task $task): JsonResponse
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $task->toggleComplete();

        return response()->json([
            'is_completed' => $task->is_completed,
            'completion_percentage' => Auth::user()->todaysCompletionPercentage(),
        ]);
    }

    public function destroy(Task $task): RedirectResponse
    {
        abort_unless($task->user_id === Auth::id(), 403);

        $task->delete();

        return back()->with('status', 'Task deleted.');
    }
}