<x-layouts.app title="Calendars">
    <div class="mx-auto max-w-3xl space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="font-display text-2xl font-semibold">Calendars</h1>
        </div>

        <form method="POST" action="{{ route('calendars.store') }}" class="flex flex-wrap gap-2 rounded-xl2 border border-ink-700 bg-ink-800/60 p-4">
            @csrf
            <input type="text" name="name" placeholder="Calendar name" required
                   class="flex-1 min-w-[160px] rounded-md border-ink-600 bg-ink-800 text-sm text-paper placeholder:text-muted/60 focus:border-glow focus:ring-glow">
            <select name="type" class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">
                <option value="work">Work</option>
                <option value="study">Study</option>
                <option value="exhibition">Exhibition</option>
                <option value="lecture">Lecture / Lab</option>
                <option value="birthday">Birthday</option>
                <option value="custom">Custom</option>
            </select>
            <input type="color" name="color" value="#8B87F5" class="h-9 w-12 rounded-md border-ink-600 bg-ink-800">
            <button type="submit" class="rounded-md bg-glow px-4 text-sm font-medium text-ink-950">Add calendar</button>
        </form>

        <div class="grid gap-3 sm:grid-cols-2">
            @foreach ($calendars as $calendar)
                <a href="{{ route('calendars.show', $calendar) }}"
                   class="flex items-center justify-between rounded-xl2 border border-ink-700 bg-ink-800/60 p-4 hover:border-glow/40 transition">
                    <div class="flex items-center gap-2">
                        <span class="h-2.5 w-2.5 rounded-full" style="background-color: {{ $calendar->color }}"></span>
                        <div>
                            <p class="text-sm font-medium text-paper">{{ $calendar->name }}</p>
                            <p class="text-xs text-muted capitalize">{{ $calendar->type }}</p>
                        </div>
                    </div>
                    <span class="text-xs text-muted font-mono">{{ $calendar->events_count }}</span>
                </a>
            @endforeach
        </div>
    </div>
</x-layouts.app>