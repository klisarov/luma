<?php

namespace App\Http\Controllers;

use App\Models\WorkoutPlan;
use App\Services\FitnessTipService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WorkoutPlanController extends Controller
{
    public function index(FitnessTipService $tipService): View
    {
        $user = Auth::user();

        $plans = $user->workoutPlans()->orderBy('day_of_week')->orderBy('scheduled_time')->get()
            ->groupBy('day_of_week');

        $tip = $user->sex ? $tipService->getTipFor($user->sex) : null;

        return view('fitness.index', compact('plans', 'tip'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'day_of_week' => ['required', 'integer', 'between:0,6'],
            'scheduled_time' => ['required', 'date_format:H:i'],
            'workout_type' => ['required', 'string', 'max:255'],
            'duration_minutes' => ['nullable', 'integer', 'min:5'],
            'notes' => ['nullable', 'string'],
        ]);

        Auth::user()->workoutPlans()->create($validated);

        return back()->with('status', 'Workout added.');
    }

    public function destroy(WorkoutPlan $workoutPlan): RedirectResponse
    {
        abort_unless($workoutPlan->user_id === Auth::id(), 403);

        $workoutPlan->delete();

        return back()->with('status', 'Workout removed.');
    }
}