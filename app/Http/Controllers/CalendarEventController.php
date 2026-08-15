<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\CalendarEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarEventController extends Controller
{
    public function store(Request $request, Calendar $calendar): RedirectResponse
    {
        abort_unless($calendar->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_all_day' => ['nullable', 'boolean'],
            'is_recurring_yearly' => ['nullable', 'boolean'],
            'notify_before_minutes' => ['nullable', 'integer', 'min:0'],
        ]);

        $calendar->events()->create($validated);

        return back()->with('status', 'Event added.');
    }

    public function update(Request $request, CalendarEvent $calendarEvent): RedirectResponse
    {
        abort_unless($calendarEvent->calendar->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_all_day' => ['nullable', 'boolean'],
            'is_recurring_yearly' => ['nullable', 'boolean'],
            'notify_before_minutes' => ['nullable', 'integer', 'min:0'],
        ]);

        $calendarEvent->update($validated);

        return back()->with('status', 'Event updated.');
    }

    public function destroy(CalendarEvent $calendarEvent): RedirectResponse
    {
        abort_unless($calendarEvent->calendar->user_id === Auth::id(), 403);

        $calendarEvent->delete();

        return back()->with('status', 'Event deleted.');
    }
}