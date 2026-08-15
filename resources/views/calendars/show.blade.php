<x-layouts.app :title="$calendar->name">
    <div class="mx-auto max-w-3xl space-y-6">
        <div class="flex items-center gap-2">
            <span class="h-3 w-3 rounded-full" style="background-color: {{ $calendar->color }}"></span>
            <h1 class="font-display text-2xl font-semibold">{{ $calendar->name }}</h1>
        </div>

        <form method="POST" action="{{ route('calendar-events.store', $calendar) }}"
              class="grid gap-3 rounded-xl2 border border-ink-700 bg-ink-800/60 p-4 sm:grid-cols-2">
            @csrf
            <input type="text" name="title" placeholder="Event title" required
                   class="sm:col-span-2 rounded-md border-ink-600 bg-ink-800 text-sm text-paper placeholder:text-muted/60 focus:border-glow focus:ring-glow">
            <input type="text" name="location" placeholder="Location (optional)"
                   class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper placeholder:text-muted/60 focus:border-glow focus:ring-glow">
            <select name="notify_before_minutes" class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">
                <option value="">No reminder</option>
                <option value="15">15 min before</option>
                <option value="30">30 min before</option>
                <option value="60">1 hour before</option>
                <option value="1440">1 day before</option>
            </select>
            <input type="datetime-local" name="starts_at" required
                   class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">
            <input type="datetime-local" name="ends_at"
                   class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">
            <button type="submit" class="sm:col-span-2 rounded-md bg-glow px-4 py-2 text-sm font-medium text-ink-950">Add event</button>
        </form>

        <div class="divide-y divide-ink-700 rounded-xl2 border border-ink-700 bg-ink-800/60">
            @forelse ($calendar->events as $event)
                <div class="flex items-center justify-between px-5 py-3.5">
                    <div>
                        <p class="text-sm font-medium text-paper">{{ $event->title }}</p>
                        <p class="text-xs text-muted font-mono">
                            {{ $event->starts_at->format('j M Y · H:i') }}
                            @if ($event->location) · {{ $event->location }} @endif
                        </p>
                    </div>
                    <form method="POST" action="{{ route('calendar-events.destroy', $event) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-muted hover:text-paper">Remove</button>
                    </form>
                </div>
            @empty
                <p class="px-5 py-8 text-center text-sm text-muted">No events yet.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>