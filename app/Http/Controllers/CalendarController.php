<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function index(): View
    {
        $calendars = Auth::user()->calendars()->withCount('events')->get();

        return view('calendars.index', compact('calendars'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:work,study,exhibition,lecture,birthday,custom'],
            'color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        Auth::user()->calendars()->create($validated);

        return back()->with('status', 'Calendar created.');
    }

    public function show(Calendar $calendar): View
    {
        abort_unless($calendar->user_id === Auth::id(), 403);

        $calendar->load(['events' => fn ($q) => $q->orderBy('starts_at')]);

        return view('calendars.show', compact('calendar'));
    }

    public function update(Request $request, Calendar $calendar): RedirectResponse
    {
        abort_unless($calendar->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $calendar->update($validated);

        return back()->with('status', 'Calendar updated.');
    }

    public function destroy(Calendar $calendar): RedirectResponse
    {
        abort_unless($calendar->user_id === Auth::id(), 403);

        $calendar->delete();

        return redirect()->route('calendars.index')->with('status', 'Calendar deleted.');
    }
}