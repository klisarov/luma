<x-layouts.app :title="$calendar->name">
    <div class="mx-auto max-w-3xl space-y-6">

        {{-- Calendar header --}}
        <div class="flex items-center gap-2">
            <span
                class="h-3 w-3 rounded-full"
                style="background-color: {{ $calendar->color ?? '#F5B942' }}"
            ></span>

            <h1 class="font-display text-2xl font-semibold text-paper">
                {{ $calendar->name }}
            </h1>
        </div>


        {{-- Add event --}}
        <form
            method="POST"
            action="{{ route('calendar-events.store') }}"
            class="grid gap-3 rounded-xl2 border border-ink-700 bg-ink-800/60 p-4 sm:grid-cols-2"
        >
            @csrf

            {{-- IMPORTANT: calendar goes as POST data --}}
            <input
                type="hidden"
                name="calendar_id"
                value="{{ $calendar->id }}"
            >

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="Event title"
                required
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    placeholder:text-muted/60
                    focus:border-glow
                    focus:ring-glow
                    sm:col-span-2
                "
            >

            <input
                type="text"
                name="location"
                value="{{ old('location') }}"
                placeholder="Location (optional)"
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    placeholder:text-muted/60
                    focus:border-glow
                    focus:ring-glow
                "
            >

            <select
                name="notify_before_minutes"
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    focus:border-glow
                    focus:ring-glow
                "
            >
                <option value="">No reminder</option>

                <option
                    value="15"
                    @selected(old('notify_before_minutes') === '15')
                >
                    15 min before
                </option>

                <option
                    value="30"
                    @selected(old('notify_before_minutes') === '30')
                >
                    30 min before
                </option>

                <option
                    value="60"
                    @selected(old('notify_before_minutes') === '60')
                >
                    1 hour before
                </option>

                <option
                    value="1440"
                    @selected(old('notify_before_minutes') === '1440')
                >
                    1 day before
                </option>
            </select>

            <input
                type="datetime-local"
                name="starts_at"
                value="{{ old('starts_at') }}"
                required
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    focus:border-glow
                    focus:ring-glow
                "
            >

            <input
                type="datetime-local"
                name="ends_at"
                value="{{ old('ends_at') }}"
                class="
                    rounded-md
                    border-ink-600
                    bg-ink-800
                    text-sm text-paper
                    focus:border-glow
                    focus:ring-glow
                "
            >

            @if ($errors->any())
                <div class="sm:col-span-2 rounded-lg border border-red-500/20 bg-red-500/10 p-3">
                    <ul class="space-y-1 text-xs text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button
                type="submit"
                class="
                    rounded-md
                    bg-glow
                    px-4 py-2
                    text-sm font-medium
                    text-ink-950
                    transition
                    hover:brightness-110
                    sm:col-span-2
                "
            >
                Add event
            </button>
        </form>


        {{-- Events --}}
        <div class="divide-y divide-ink-700 rounded-xl2 border border-ink-700 bg-ink-800/60">

            @forelse ($calendar->events as $event)

                <div class="flex items-center justify-between gap-4 px-5 py-3.5">

                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium text-paper">
                            {{ $event->title }}
                        </p>

                        <p class="mt-0.5 text-xs font-mono text-muted">
                            {{ $event->starts_at->format('j M Y · H:i') }}

                            @if ($event->location)
                                · {{ $event->location }}
                            @endif
                        </p>

                        @if ($event->notify_before_minutes)
                            <p class="mt-1 text-xs text-muted/70">
                                Reminder:
                                @if ($event->notify_before_minutes === 1440)
                                    1 day before
                                @elseif ($event->notify_before_minutes === 60)
                                    1 hour before
                                @else
                                    {{ $event->notify_before_minutes }} min before
                                @endif
                            </p>
                        @endif
                    </div>

                    <form
                        method="POST"
                        action="{{ route('calendar-events.destroy', $event) }}"
                        onsubmit="return confirm('Remove this event?')"
                        class="shrink-0"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="
                                rounded-md
                                px-2 py-1
                                text-xs text-muted
                                transition
                                hover:bg-red-500/10
                                hover:text-red-400
                            "
                        >
                            Remove
                        </button>
                    </form>

                </div>

            @empty

                <p class="px-5 py-8 text-center text-sm text-muted">
                    No events yet.
                </p>

            @endforelse

        </div>

    </div>
</x-layouts.app>