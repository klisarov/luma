<x-layouts.app title="Fitness">
    <div class="mx-auto max-w-4xl space-y-6">
        <h1 class="font-display text-2xl font-semibold">Fitness tracker</h1>

        @if ($tip)
            <div class="rounded-xl2 border border-glow/30 bg-glow/10 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-glow">Today's tip</p>
                <p class="mt-1 text-sm text-paper">{{ $tip }}</p>
            </div>
        @elseif (! auth()->user()->sex)
            <div class="rounded-xl2 border border-ink-700 bg-ink-800/60 p-4 text-sm text-muted">
                Set your profile details to get personalized fitness tips.
                <a href="{{ route('profile.edit') }}" class="text-glow hover:underline">Update profile</a>
            </div>
        @endif

        {{-- Add workout --}}
        <form method="POST" action="{{ route('workout-plans.store') }}"
              class="grid gap-3 rounded-xl2 border border-ink-700 bg-ink-800/60 p-4 sm:grid-cols-2 lg:grid-cols-4">
            @csrf
            <select name="day_of_week" class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">
                @foreach (['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $i => $day)
                    <option value="{{ $i }}">{{ $day }}</option>
                @endforeach
            </select>
            <input type="time" name="scheduled_time" required
                   class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper focus:border-glow focus:ring-glow">
            <input type="text" name="workout_type" placeholder="e.g. Push day" required
                   class="rounded-md border-ink-600 bg-ink-800 text-sm text-paper placeholder:text-muted/60 focus:border-glow focus:ring-glow">
            <div class="flex gap-2">
                <input type="number" name="duration_minutes" placeholder="60 min" min="5"
                       class="w-full rounded-md border-ink-600 bg-ink-800 text-sm text-paper placeholder:text-muted/60 focus:border-glow focus:ring-glow">
                <button type="submit" class="shrink-0 rounded-md bg-glow px-3 text-sm font-medium text-ink-950">Add</button>
            </div>
        </form>

        {{-- Weekly grid --}}
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-7">
            @foreach (['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $i => $label)
                <div class="rounded-xl2 border border-ink-700 bg-ink-800/60 p-3">
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-muted">{{ $label }}</p>
                    <div class="space-y-2">
                        @forelse ($plans->get($i, collect()) as $workout)
                            <div class="rounded-lg bg-ink-700 p-2">
                                <p class="text-xs font-medium text-paper">{{ $workout->workout_type }}</p>
                                <p class="text-[11px] text-muted font-mono">
                                    {{ \Illuminate\Support\Carbon::parse($workout->scheduled_time)->format('H:i') }}
                                    · {{ $workout->duration_minutes }}min
                                </p>
                                <form method="POST" action="{{ route('workout-plans.destroy', $workout) }}" class="mt-1">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-[10px] text-muted hover:text-paper">Remove</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-[11px] text-muted/50">Rest</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>