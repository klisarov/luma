<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $today = now($user->timezone)->toDateString();

        $todaysTasks = $user->todaysTasks()
            ->with(['category', 'subcategory'])
            ->orderBy('due_at')
            ->get();

        $remainingTasks = $user->tasks()
            ->with(['category', 'subcategory'])
            ->where('is_completed', false)
            ->where(function ($query) use ($today) {
                $query
                    ->whereNull('due_date')
                    ->orWhereDate('due_date', '!=', $today);
            })
            ->orderByRaw('due_at IS NULL')
            ->orderBy('due_at')
            ->get();

        return view('dashboard.index', [
            'categories' => $user->categories()
                ->withCount('tasks')
                ->get(),

            'todaysTasks' => $todaysTasks,

            'remainingTasks' => $remainingTasks,

            'completionPercentage' => $user->todaysCompletionPercentage(),

            'calendars' => $user->calendars()
                ->with([
                    'events' => fn ($q) => $q
                        ->where('starts_at', '>=', now())
                        ->orderBy('starts_at')
                        ->limit(5),
                ])
                ->get(),
        ]);
    }
}